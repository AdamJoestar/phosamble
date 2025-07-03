<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Board $board)
    {
        // Authorization check: ensure the board belongs to the authenticated user
        abort_if($board->user_id !== auth()->id(), 403);

        $request->validate(['body' => 'required|string']);

        $board->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back();
    }
}
