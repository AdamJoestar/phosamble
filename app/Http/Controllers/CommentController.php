<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Board $board)
    {
        // Authorization check: ensure the board belongs to the authenticated user or user is a member
        abort_if($board->user_id !== Auth::id() && !$board->members->contains(Auth::id()), 403);

        $request->validate(['body' => 'required|string']);

        $board->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back();
    }
}
