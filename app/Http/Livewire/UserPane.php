<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserPane extends Component
{
    public $user;
    public $roleOptions = ['Admin', 'Standard'];
    public $confirmingUserDeletion;

    public $editable = false;

    public $firstname;
    public $lastname;
    public $email;
    public $role;

    public function render()
    {

        return view('livewire.user-pane');
    }

    public function mount()
    {
        if (isset($this->user)) {
            $this->firstname = $this->user->first_name;
            $this->lastname = $this->user->last_name;
            $this->email = $this->user->email;
            $this->role = $this->user->role;
        }
    }

    public function edit()
    {
        $this->editable = true;
    }

    public function save()
    {


        $this->user->first_name = $this->firstname;
        $this->user->last_name = $this->lastname;
        $this->user->email = $this->email;
        $this->user->role = $this->role;
        $this->user->save();


        $this->editable = false;
    }

    public function requestDelete()
    {
        $this->confirmingUserDeletion = true;
    }

    public function cancelDelete()
    {
        $this->confirmingUserDeletion = false;
        dd($this->confirmingUserDeletion);
    }

    public function delete()
    {
        $this->user->delete();
        $this->user = null;
    }
}
