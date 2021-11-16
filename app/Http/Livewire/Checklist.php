<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checklist extends Component
{

    public $checklist;

    public function render()
    {

        if (!is_array($this->checklist)) {
            $this->checklist = array();
        }

        return view('livewire.checklist', ['checklist' => $this->checklist]);
    }

    public function removeItem($key)
    {
        unset($this->checklist[$key]);

        // $this->checklist = array_values($this->checklist);
    }

    public function addItem()
    {
        $checklistitem = array();
        $checklistitem[0] = "New Checklist Item";
        $checklistitem[1] = false;

        array_push($this->checklist, $checklistitem);
    }
}
