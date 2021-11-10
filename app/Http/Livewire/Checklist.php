<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checklist extends Component
{

    public $checklist;
    public $items;
    public $names;
    public $ischecked;

    public function render()
    {

        if (!is_array($this->checklist)) {
            $this->checklist = array();
        }

        return view('livewire.checklist', ['checklist' => $this->checklist]);
    }

    public function addItem()
    {
        $checklistitem = array();
        $checklistitem[0] = "New Checklist Item";
        $checklistitem[1] = true;

        array_push($this->checklist, $checklistitem);

        $this->names[count($this->checklist) - 1] = $checklistitem[0];
        $this->ischecked[count($this->checklist) - 1] = $checklistitem[1];
    }

    public function nameChanged()
    {
        $c = 0;
        foreach ($this->names as $name) {
            $this->checklist[$c][0] = $name;
            $c++;
        }
    }

    public function checkboxChanged()
    {
        $c = 0;
        foreach ($this->ischecked as $check) {
            $this->checklist[$c][1] = $check;
            $c++;
        }
    }
}
