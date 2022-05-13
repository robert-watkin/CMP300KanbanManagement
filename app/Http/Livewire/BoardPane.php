<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDO;

class BoardPane extends Component
{
    public $board;

    public $editable = false;

    public $title;
    public $cards;

    public function render()
    {
        return view('livewire.board-pane');
    }

    public function mount()
    {
        $this->title = $this->board->title;

        // get count of cards
        $c = 0;
        foreach ($this->board->buckets as $bucket) {
            $c = $c + count($bucket->cards);
        }

        $this->cards = $c;
    }

    public function edit()
    {
        // set the inline editor to true - front end handles showing inputs
        $this->editable = true;
    }

    public function save()
    {
        $this->board->title = $this->title;
        $this->board->save();

        $this->editable = false;
    }

    public function delete()
    {
        $this->board->delete();
        $this->board = null;
    }
}
