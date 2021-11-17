<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Bucket;
use App\Models\Board;
use App\Models\CardMember;
use App\Models\CheckListItem;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!request()->has('bucketid')) {
            return redirect()->route("board.index");
        }


        $bucket = Bucket::find(request()->bucketid);
        $board = Board::find($bucket->board_id);

        return view('card.create', ['bucket' => $bucket, 'board' => $board]);
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
            ],
            'description' => [
                'required'
            ],
            'deadline' => [
                'required'
            ]
        ]);


        // create and save card
        $card = new Card();
        $card->title = $request['title'];
        $card->description = $request['description'];
        $card->deadline = date('Y-m-d', strtotime($request['deadline']));
        $card->bucket_id = $request['bucketid'];
        $card->save();

        // create and save member assignment
        $assigned = json_decode($request['assigned']);

        foreach ((array) $assigned as $member) {
            $assignment = new CardMember();
            $assignment->card_id = $card->id;
            $assignment->user_id = $member->id;

            $assignment->save();
        }

        // create and save checklist
        $checklist = json_decode($request['checklist']);

        foreach ((array) $checklist as $checklistitem) {
            $item = new CheckListItem();
            $item->name = $checklistitem[0];
            $item->is_complete = $checklistitem[1];
            $item->card_id = $card->id;
            $item->save();
        }

        $boardid = $request['boardid'];

        return redirect()->route('board.show', $boardid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        // TODO USE THIS ROUTE FOR VIEWERS (NON EDITORS OR ADMINS)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
        $card = Card::find($card)->first();

        if (!request()->has('bucketid')) {
            return redirect()->route("board.index");
        }

        $bucket = Bucket::find(request()->bucketid);
        $board = Board::find($bucket->board_id);


        return view('card.edit', ["card" => $card, "bucket" => $bucket, "board" => $board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }
}
