<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardComponent extends Component
{
    public $card;

    public function render()
    {

        $users = $this->card->users()->get();

        return view('livewire.card-component', ['bucketid' => $this->card->bucket_id, 'card' => $this->card, 'assigned' => $users]);
    }
}
