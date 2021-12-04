<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Board;
use App\Models\BoardMember;
use Illuminate\Http\Request;

class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display base page telling user to select or create a board
        return view('board-selection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view to create board
        return view('board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required'
            ]
        ]);

        $title = $request->input('title');
        $members = json_decode($request->input('members'));

        $test = array($title, $members);

        // create and save board to db
        $board = new Board;
        $board->title = $title;
        $board->save();

        // create and save each board member
        foreach ($members as $member) {
            $boardmember = new BoardMember();
            $boardmember->board_id = $board->id;
            $boardmember->user_id = $member[4];
            $boardmember->status = $member[1];
            $boardmember->role = $member[2];
            $boardmember->save();
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        // check if user is a member of the board
        if (Auth::user()->role != "Admin") {
            $isMember = false;
            foreach ($board->users as $link) {
                if ($link->user_id == Auth::user()->id) {
                    $isMember = true;
                }
            }

            if ($isMember === false) {
                return redirect()->route('board.index');
            }
        }

        return view('board.show')->with(compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        // check if user is a member of the board
        if (Auth::user()->role != "Admin") {
            $isMember = false;
            foreach ($board->users as $link) {
                if ($link->user_id == Auth::user()->id) {
                    $isMember = true;
                }
            }

            if ($isMember === false) {
                return redirect()->route('board.index');
            }
        }


        $board = Board::find($board)->first();

        return view('board.edit')->with(compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        // check if user is a member of the board
        if (Auth::user()->role != "Admin") {
            $isMember = false;
            foreach ($board->users as $link) {
                if ($link->user_id == Auth::user()->id) {
                    $isMember = true;
                }
            }

            if ($isMember === false) {
                return redirect()->route('board.index');
            }
        }

        $request->validate([
            'title' => [
                'required'
            ]
        ]);

        $board = Board::find($board)->first();
        $board->title = $request->input('title');
        $board->save();

        $members = json_decode($request->input('members'));


        // edit and save each board member
        foreach ($members as $member) {
            // if the member exists then edit. If the member doesn't exits then add them to the DB
            $toedit = BoardMember::where(['user_id' => $member[4], 'board_id' => $board->id])->first();

            if ($toedit === null) {
                $toedit = new BoardMember();
                $toedit->board_id = $board->id;
                $toedit->user_id = $member[4];
                $toedit->status = $member[1];
                $toedit->role = $member[2];
                $toedit->save();
            } else {
                $toedit->role = $member[2];
                $toedit->save();
            }
        }

        $allMembers = BoardMember::where(['board_id' => $board->id])->get();

        // check and delete members that no longer exist
        foreach ($allMembers as $DBmember) {
            $exists = false;
            foreach ($members as $member) {
                if ($DBmember->user_id == $member[4]) {
                    $exists = true;
                }
            }

            if (!$exists) {
                $DBmember->delete();
            }
        }

        return redirect()->route('board.show', $board->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        // check if user is a member of the board
        if (Auth::user()->role != "Admin") {
            $isMember = false;
            foreach ($board->users as $link) {
                if ($link->user_id == Auth::user()->id) {
                    $isMember = true;
                }
            }

            if ($isMember === false) {
                return redirect()->route('board.index');
            }
        }


        $board = Board::find($board)->first();
        $board->delete();

        return redirect()->route('board.index');
    }
}
