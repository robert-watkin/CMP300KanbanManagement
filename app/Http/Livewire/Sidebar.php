<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        // get the logged in user
        $user = Auth::user();

        // get boards
        $boardLinks = $user->boards()->get();
        $boardList = array();
        foreach ($boardLinks as $boardLink) {
            $boards = $boardLink->board()->get();
            $board = $boards[0];
            array_push($boardList, $board);
        }

        // TODO notifications



        return view('livewire.sidebar')->with(compact('boardList', 'user'));
    }
}
