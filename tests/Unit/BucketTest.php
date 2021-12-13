<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Board;
use App\Models\Bucket;
use App\Http\Livewire\BucketPanel;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Http\Request;

class BucketTest extends TestCase
{
    public function test_bucket_can_be_created()
    {
        // create authed user
        $this->actingAs($user = User::factory()->create());

        $board = Board::factory()->create();

        Livewire::test(BucketPanel::class, ['board' => $board])->call('newBucket');

        $this->assertTrue(Bucket::where('board_id', $board->id)->exists());
        $this->assertTrue(Bucket::where('title', 'New Bucket')->exists());
    }

    public function test_bucket_can_be_updated()
    {
    }

    public function test_bucket_can_be_deleted()
    {
    }
}
