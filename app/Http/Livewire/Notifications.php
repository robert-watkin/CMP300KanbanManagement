<?php

namespace App\Http\Livewire;

use App\Models\BoardMember;
use App\Models\Card;
use App\Models\CardMember;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    public function render()
    {
        // get board invitations
        $thisUserMember = BoardMember::where(['user_id' => Auth::user()->id, 'status' => 'Pending'])->get();

        // get overdue tasks
        // get all cards the user is assigned to 
        $assignedCards = CardMember::where(['user_id' => Auth::user()->id])->get();



        // check deadlines on the cards
        $now = date("Y-m-d");
        $lateTasks = array();
        foreach ($assignedCards as $cardLink) {
            $boardLink = BoardMember::where(['board_id' => $cardLink->card->bucket->board->id, 'user_id' => Auth::user()->id])->first();
            if ($boardLink->status == "Accepted") {
                $card = $cardLink->card()->first();
                if ($card->deadline < $now) {
                    array_push($lateTasks, $card);
                }
            }
        }

        return view('livewire.notifications', ['invitations' => $thisUserMember, 'lateTasks' => $lateTasks]);
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
