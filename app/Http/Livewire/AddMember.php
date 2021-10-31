<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class AddMember extends Component
{
    public $members;
    public $email;
    public $role = "Admin";
    public $error;
    public $authorAdded = false;
    public $roleOptions = ["Admin", "Editor", "Viewer"];

    public function render()
    {

        if (!is_array($this->members)) {
            $this->members = array();
        }


        if (!$this->authorAdded) {
            $this->authorAdded = true;
            // get info for the membes
            $user = Auth::user();
            $name = $user->first_name . " " . $user->last_name;
            $status = "accepted";
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
        $status = "pending";


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
}
