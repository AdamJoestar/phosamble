<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
    public function index()
    {
        $boards = auth()->user()->boards()->latest()->get();
        return view('boards.index', compact('boards'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        auth()->user()->boards()->create($request->only('title'));
        return redirect()->route('boards.index');
    }

    public function show(Board $board)
    {
        // Pastikan user hanya bisa melihat board miliknya (akan kita tambahkan sharing nanti)
        abort_if($board->user_id !== auth()->id(), 403);
        return view('boards.show', compact('board'));
    }
}