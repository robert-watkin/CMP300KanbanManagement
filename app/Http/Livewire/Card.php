<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Card extends Component
{
    public $card;
    public function render()
    {
        return view('livewire.card', $this->card);
    }
}
