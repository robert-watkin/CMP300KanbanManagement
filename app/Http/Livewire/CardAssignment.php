<?php

namespace App\Http\Livewire;

use App\Models\Board;
use App\Models\BoardMember;
use App\Models\User;
use Livewire\Component;

class CardAssignment extends Component
{

    public $assignedtocard;
    public $members;
    public $board;

    public function render()
    {
        // TODO only allow assignment of editors and admins

        $boardmembers = BoardMember::where(['board_id' => $this->board->id])->get();

        if (!is_array($this->members)) {
            $this->members = array();
        }

        if (!is_array($this->assignedtocard)) {
            $this->assignedtocard = array();
        }

        $counter = 0;
        foreach ($boardmembers as $member) {
            // check if the member has already been added to the selection list
            if (in_array($member->user()->first(), $this->members)) {
                continue;
            }

            // check if the member has already been added to the card
            foreach ($this->assignedtocard as $user) {
                if ($user->id == $member->user_id) {
                    continue 2;
                }
            }

            $counter++;

            $user = $member->user()->first();
            array_push($this->members, $user);
        }

        return view('livewire.card-assignment', ['assignedtocard' => $this->assignedtocard, 'members' => $this->members]);
    }


    public function removeUser()
    {
    }

    public function assignUser($id)
    {
        // laravel converts the eloquent objects to normal arrays for some unknown reason on the action call so setting them back to laravel objects https://github.com/livewire/livewire/issues/27
        $temp = $this->members;
        $this->members = array();

        foreach ($temp as $member) {
            $user = User::where(['id' => $member['id']])->first();
            array_push($this->members, $user);
        }

        // same for assigned to card 
        $temp = $this->assignedtocard;
        $this->assignedtocard = array();

        foreach ($temp as $member) {
            $user = User::where(['id' => $member['id']])->first();
            array_push($this->assignedtocard, $user);
        }



        foreach ($this->members as $member) {
            if ($member->id == $id) {
                array_push($this->assignedtocard, $member);

                if (($key = array_search($member, $this->members)) !== false) {
                    unset($this->members[$key]);
                }
                break;
            }
        }
    }
}
