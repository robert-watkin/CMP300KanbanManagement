<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{

    public $card;
    public $commentContent;

    public function render()
    {
        $comments = array();
        // get all comments for this card
        if ($this->card != null) {
            $comments = $this->card->comments()->get();
        }

        $users = array();
        foreach ($comments as $comment) {
            $user = $comment->user()->get();
            array_push($users, $user[0]);
        }

        return view('livewire.comments', ['comments' => $comments, 'users' => $users]);
    }

    public function send()
    {
        $comment = new Comment();
        $comment->comment = $this->commentContent;
        $comment->card_id = $this->card->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
    }
}
