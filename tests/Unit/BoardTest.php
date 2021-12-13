<?php

namespace Tests\Unit;

use App\Http\Controllers\BoardsController;
use App\Models\User;
use App\Models\Board;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;
use Illuminate\Http\Request;




class BoardTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_board_page_can_be_rendered()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        // access the create page
        $response = $this->get('/board/create');

        $response->assertStatus(200);
    }

    public function test_boards_can_be_created()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        // create request
        $request = Request::create('/board/store', 'POST', [
            'title' => 'foo',
            'members' => '{}'
        ]);

        // run request
        $controller = new BoardsController();
        $response = $controller->store($request);

        // checkr request status
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_boards_can_be_edited()
    {
        // create admin
        $user = User::factory()->create();
        $user->role = 'Admin';
        $this->actingAs($user);

        // create board
        $board = Board::factory()->create();

        // setup update request
        $request = Request::create('/board/{board}', 'PUT', [
            'title' => 'New Title',
            'members' => '{}'
        ]);

        // run request
        $controller = new BoardsController();
        $response = $controller->update($request, $board);

        // check updated value is present
        $this->assertEquals('New Title', $board->fresh()->title);
    }

    public function test_boards_can_be_deleted()
    {
        // create admin
        $user = User::factory()->create();
        $user->role = 'Admin';
        $this->actingAs($user);

        // create board
        $board = Board::factory()->create();


        // run request
        $controller = new BoardsController();
        $response = $controller->destroy($board);

        // check updated value is present
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_board_members_can_be_added()
    {
        // create admin
        $user = User::factory()->create();
        $user->role = 'Admin';
        $this->actingAs($user);

        // setup member to add
        $memberToAdd = User::factory()->create();
        $name = $memberToAdd->first_name . ' ' . $memberToAdd->last_name;
        $status = "Accepted";
        $role = "Admin";

        // single member entry
        $member = array();
        array_push($member, $name);
        array_push($member, $status);
        array_push($member, $role);
        array_push($member, $memberToAdd->email);
        array_push($member, $memberToAdd->id);

        // members array which *could hold multiple members
        $members = array();
        array_push($members, $member);

        // create board
        $board = Board::factory()->create();

        // setup update request
        $request = Request::create('/board/{board}', 'PUT', [
            'title' => 'New Title',
            'members' => json_encode($members)
        ]);

        // run request
        $controller = new BoardsController();
        $response = $controller->update($request, $board);

        // check updated value is present
        $this->assertEquals($memberToAdd->id, $board->users()->first()->user_id);
    }
}
