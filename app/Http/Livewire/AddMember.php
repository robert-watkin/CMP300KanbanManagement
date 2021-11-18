<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AddMember extends Component
{
    public $members;
    public $board;
    public $email;
    public $role = "Admin";
    public $roles;
    public $error;
    public $authorAdded = false;
    public $roleOptions = ["Admin", "Editor", "Viewer"];
    public $dataLoaded = false;

    public function render()
    {

        if (!is_array($this->members)) {
            $this->members = array();
        }

        // if the current route is for editing - load data

        if (Route::currentRouteName() == "board.edit" && $this->dataLoaded == false) {
            $boardmembers = BoardMember::where(['board_id' => $this->board->id])->get();

            foreach ($boardmembers as $boardmember) {
                $user = User::where(['id' => $boardmember->user_id])->first();

                $name = $user->first_name . " " . $user->last_name;

                $member = array();

                array_push($member, $name);
                array_push($member, $boardmember->status);
                array_push($member, $boardmember->role);
                array_push($member, $user->email);
                array_push($member, $user->id);

                // add member to members array
                array_push($this->members, $member);
            }

            $this->dataLoaded = true;
        }



        if (!isset($this->members[0])) {
            $this->authorAdded = true;
            // get info for the membes
            $user = Auth::user();
            $name = $user->first_name . " " . $user->last_name;
            $status = "Accepted";
            $role = "Admin";

            $member = array();
            array_push($member, $name);
            array_push($member, $status);
            array_push($member, $role);
            array_push($member, $user->email);
            array_push($member, $user->id);

            // add member to members array
            array_push($this->members, $member);
        }


        // set roles from members array
        foreach ($this->members as $member) {
            $this->roles[$member[4]] = $member[2];
        }



        return view('livewire.add-member', ['members' => $this->members, 'error' => $this->error, 'roleOptions' => $this->roleOptions]);
    }

    public function addMember()
    {

        // get user and empty error
        $user = User::where('email', $this->email)->first();
        $this->error = null;

        // check if the user exists
        if (empty($user)) {
            $this->error = "The user cannot be Found";
            return;
        }

        // check if the members var is an array
        if (is_array($this->members)) {
            // check the user hasn't been added already 
            foreach ($this->members as $member) {
                if ($member[3] == $this->email) {
                    $this->error = "The user has already been added to the board";
                    return;
                }
            }
        } else {
            $this->members = array();
        }

        // create the member array
        $member = array();

        // get info for the membes
        $name = $user->first_name . " " . $user->last_name;
        $status = "Pending";


        // add variables to member
        array_push($member, $name);
        array_push($member, $status);
        array_push($member, $this->role);
        array_push($member, $this->email);
        array_push($member, $user->id);

        // add member to members array
        array_push($this->members, $member);

        $this->render();
    }

    public function removeMember($member)
    {
        // search for and remove the member from the array
        if (($key = array_search($member, $this->members)) !== false) {
            unset($this->members[$key]);
        }
    }

    public function roleChange()
    {
        $keys = array_keys($this->roles);
        $counter = 0;
        foreach ($this->roles as $role) {
            $this->members[$counter][2] = $role;
            $counter++;
        }
    }
}
