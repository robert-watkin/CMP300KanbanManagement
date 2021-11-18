<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;


class Checklist extends Component
{

    public $checklist;
    public $dataLoaded = false;
    public $card;

    public function render()
    {
        if (!is_array($this->checklist)) {
            $this->checklist = array();
        }

        if (Route::currentRouteName() == "card.edit" && $this->dataLoaded == false) {
            foreach ($this->card->checklist as $item) {

                $checklistitem = array();
                $checklistitem[0] = $item->name;
                $checklistitem[1] = $item->is_complete;
                $checklistitem[2] = $item->id;

                array_push($this->checklist, $checklistitem);
            }

            $dataloaded = true;
        }

        return view('livewire.checklist', ['checklist' => $this->checklist]);
    }

    public function removeItem($key)
    {
        unset($this->checklist[$key]);
    }

    public function addItem()
    {
        $checklistitem = array();
        $checklistitem[0] = "New Checklist Item";
        $checklistitem[1] = false;
        $checklistitem[2] = "new";

        array_push($this->checklist, $checklistitem);
    }
}
