<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bucket;
use App\Models\Card;
use App\Models\Board;
use Illuminate\Contracts\View\View;

class BucketPanel extends Component
{
    protected $listeners = ['hideButton' => '$refresh', 'bucketDeleted' => '$refresh', 'movingCard'];

    public $board;

    public function render(): View
    {
        return view('livewire.bucket-panel', ["board" => $this->board]);
    }


    public function newBucket()
    {
        // check if limit of 6 has been reached
        if (count($this->board->buckets) >= 6) {
            return;
        }

        $bucket = new Bucket();
        $bucket->board_id = $this->board->id;
        $bucket->title = "New Bucket";
        $bucket->save();

        // refresh board model for count checks
        $this->board = Board::find($this->board->id);
    }

    public function movingCard($values)
    {
        $card_id = $values[0];
        $bucket_id = $values[1];

        $card = Card::find($card_id);
        $card->bucket_id = $bucket_id;
        $card->save();

        $this->emit('cardMoved');
    }
}
