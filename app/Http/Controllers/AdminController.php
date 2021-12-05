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
        if (auth()->user()->role != "Admin") {
            return redirect()->route('profile.show');
        }

        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function boards()
    {
        if (auth()->user()->role != "Admin") {
            return redirect()->route('profile.show');
        }

        $boards = Board::all();
        return view('admin.boards', ['boards' => $boards]);
    }
}
