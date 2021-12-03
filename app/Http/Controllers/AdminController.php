<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Board;

class AdminController extends Controller
{
    //
    public function users()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function boards()
    {
        $boards = Board::all();
        return view('admin.boards', ['boards' => $boards]);
    }
}
