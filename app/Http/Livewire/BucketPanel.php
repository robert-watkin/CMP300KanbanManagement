<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bucket;

class BucketPanel extends Component
{
    public $board;

    public function render()
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
