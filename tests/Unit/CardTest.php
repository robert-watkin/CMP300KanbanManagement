<?php

namespace Tests\Unit;

use App\Http\Controllers\CardsController;
use App\Http\Livewire\BucketComponent;
use App\Models\User;
use App\Models\Board;
use App\Models\Bucket;
use App\Http\Livewire\BucketPanel;
use App\Models\BoardMember;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Http\Request;


class CardTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_card_page_can_be_rendered()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        $bucket = Bucket::factory()->create();

        $request = Request::create('/card/create', 'GET', ['bucketid' => $bucket->id]);

        $request = $this->call('GET', '/card/create', ['bucketid' => $bucket->id]);

        $controller = new CardsController();
        $response = $controller->create($request);

        $response->assertStatus(200);
    }

    public function test_cards_can_be_created()
    {
        /*
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
        */
    }

    public function test_cards_can_be_edited()
    {
        /*
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
        */
    }

    public function test_cards_can_be_deleted()
    {
        /*
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
        */
    }
}
