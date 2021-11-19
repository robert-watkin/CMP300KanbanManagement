<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bucket;
use App\Models\Card;
use Illuminate\Contracts\View\View;

class BucketPanel extends Component
{
    protected $listeners = ['bucketDeleted' => '$refresh', 'movingCard'];

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
