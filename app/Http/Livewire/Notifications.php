<?php

namespace App\Http\Livewire;

use App\Models\BoardMember;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    public function render()
    {
        $thisUserMember = BoardMember::where(['user_id' => Auth::user()->id, 'status' => 'Pending'])->get();
        return view('livewire.notifications', ['invitations' => $thisUserMember]);
    }

    public function acceptInvitation($boardMember)
    {
        $boardMember = BoardMember::find($boardMember['id']);
        $boardMember->status = "Accepted";
        $boardMember->save();
        return redirect()->route('board.show', $boardMember->board_id);
    }

    public function declineInvitation($boardMember)
    {
        $boardMember = BoardMember::find($boardMember['id']);

        $boardMember->status = "Declined";
        $boardMember->save();
        return redirect()->route('board.index');
    }
}
