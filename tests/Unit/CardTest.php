<?php

namespace Tests\Unit;

use App\Http\Controllers\CardsController;
use App\Http\Livewire\BucketComponent;
use App\Models\User;
use App\Models\Board;
use App\Models\Bucket;
use App\Models\Card;
use App\Http\Livewire\BucketPanel;
use App\Models\BoardMember;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\ParameterBag;

class CardTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_card_page_can_be_rendered()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        $bucket = Bucket::factory()->create();
        $board = Board::find($bucket->board_id);

        $link = new BoardMember();
        $link->board_id = $board->id;
        $link->user_id = $user->id;
        $link->status = "Accepted";
        $link->role = "Editor";
        $link->save();

        $response = $this->json('GET', '/card/create', ['bucketid' => $bucket->id]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_cards_can_be_created()
    {

        $this->actingAs($user = User::factory()->create());

        $bucket = Bucket::factory()->create();
        $board = Board::find($bucket->board_id);

        $link = new BoardMember();
        $link->board_id = $board->id;
        $link->user_id = $user->id;
        $link->status = "Accepted";
        $link->role = "Editor";
        $link->save();

        // create request
        $request = Request::create('/card/store', 'POST', [
            'title' => 'foo',
            'description' => 'this is a description',
            'deadline' => date("Y/m/d"),
            'bucketid' => $bucket->id,
            'boardid' => $board->id
        ]);

        // run request
        $controller = new CardsController();
        $response = $controller->store($request);

        // search model has been created
        $card = Card::where('bucket_id', $bucket->id)->first();

        // check card has been inserted
        $this->assertEquals('foo', $card->title);
        $this->assertEquals('this is a description', $card->description);

        // check request status
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_cards_can_be_edited()
    {

        // create admin
        $user = User::factory()->create();
        $user->role = 'Admin';
        $this->actingAs($user);

        // create board
        $card = Card::factory()->create();
        $board = $card->bucket->board;

        // setup update request
        $request = Request::create('/card/{card}', 'PUT', [
            'title' => 'New Title',
            'description' => 'New Description',
            'deadline' => date('Y-m-d'),
            'boardid' => $board->id
        ]);

        // run request
        $controller = new CardsController();
        $response = $controller->update($request, $card);

        // check updated value is present
        $this->assertEquals('New Title', $card->fresh()->title);
        $this->assertEquals('New Description', $card->fresh()->description);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_cards_can_be_deleted()
    {

        // create admin
        $user = User::factory()->create();
        $user->role = 'Admin';
        $this->actingAs($user);

        // create board
        $card = Card::factory()->create();
        $id = $card->id;


        // run request
        $controller = new CardsController();
        $response = $controller->destroy($card);

        // attempt to find the card
        $card = Card::find($id);

        // asserts
        $this->assertEquals(null, $card);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
