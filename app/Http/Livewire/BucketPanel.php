<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bucket;
use Illuminate\Contracts\View\View;

class BucketPanel extends Component
{
    protected $listeners = ['bucketDeleted' => '$refresh'];

    public $board;

    public function render(): View
    {
        return view('livewire.bucket-panel', ["board" => $this->board]);
    }

    public function newBucket()
    {
        $bucket = new Bucket();
        $bucket->board_id = $this->board->id;
        $bucket->title = "New Bucket";
        $bucket->save();
    }
}
