<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Board;

class AdminController extends Controller
{
    public function users()
    {
        // check the user is an admin
        if (auth()->user()->role != "Admin") {
            return redirect()->route('profile.show');
        }

        // return all users
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function boards()
    {
        // check the user is an admin
        if (auth()->user()->role != "Admin") {
            return redirect()->route('profile.show');
        }

        // return all boards
        $boards = Board::all();
        return view('admin.boards', ['boards' => $boards]);
    }
}
