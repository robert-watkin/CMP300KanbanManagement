<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $boardLinks = Auth::user()->boards();
        $boardList = array();
        dd($boardList);
        foreach ($boardLinks as $boardLink) {
            $board = $boardLink->board();
            array_push($boardList, $board);
        }

        return view('livewire.sidebar')->with(compact('boardList'));
    }
}
