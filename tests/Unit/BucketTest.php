<?php

namespace Tests\Unit;

use App\Http\Livewire\BucketComponent;
use App\Models\User;
use App\Models\Board;
use App\Models\Bucket;
use App\Http\Livewire\BucketPanel;
use App\Models\BoardMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BucketTest extends TestCase
{
    use RefreshDatabase;

    public function test_bucket_can_be_created()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        $board = Board::factory()->create();

        // create board member link so blade can render correctly
        $link = new BoardMember();
        $link->status = "Accepted";
        $link->role = "Editor";
        $link->user_id = $user->id;
        $link->board_id = $board->id;
        $link->save();

        Livewire::test(BucketPanel::class, ['board' => $board])->call('newBucket');

        $this->assertTrue(Bucket::where('board_id', $board->id)->exists());
        $this->assertTrue(Bucket::where('title', 'New Bucket')->exists());
    }

    public function test_bucket_can_be_updated()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        $board = Board::factory()->create();

        // create board member link so blade can render correctly
        $link = new BoardMember();
        $link->status = "Accepted";
        $link->role = "Editor";
        $link->user_id = $user->id;
        $link->board_id = $board->id;
        $link->save();

        // create bucket
        $bucket = new Bucket();
        $bucket->title = "Test Title";
        $bucket->board_id = $board->id;
        $bucket->save();

        Livewire::test(BucketComponent::class, ['bucket' => $bucket])->set('bucketTitle', 'New Title')->call('updateBucket');

        $this->assertEquals('New Title', $bucket->fresh()->title);
    }

    public function test_bucket_can_be_deleted()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        $board = Board::factory()->create();

        // create board member link so blade can render correctly
        $link = new BoardMember();
        $link->status = "Accepted";
        $link->role = "Editor";
        $link->user_id = $user->id;
        $link->board_id = $board->id;
        $link->save();

        // create bucket
        $bucket = new Bucket();
        $bucket->title = "Test Title";
        $bucket->board_id = $board->id;
        $bucket->save();

        Livewire::test(BucketComponent::class, ['bucket' => $bucket])->call('deleteBucket');

        $this->assertEquals(null, Bucket::find($bucket->id));
    }
}
