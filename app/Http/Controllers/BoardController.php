<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::where('user_id', Auth::id())->latest()->get();
        return view('boards.index', compact('boards'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        Board::create(array_merge($request->only('title'), ['user_id' => Auth::id()]));
        return redirect()->route('boards.index');
    }

    public function show(Board $board)
    {
        // Pastikan user hanya bisa melihat board miliknya (akan kita tambahkan sharing nanti)
        abort_if($board->user_id !== Auth::id(), 403);
        return view('boards.show', compact('board'));
    }

    public function edit(Board $board)
    {
        abort_if($board->user_id !== Auth::id(), 403);
        return view('boards.edit', compact('board'));
    }

    public function update(Request $request, Board $board)
    {
        abort_if($board->user_id !== Auth::id(), 403);
        $request->validate(['title' => 'required|string|max:255']);
        $board->update($request->only('title'));
        return redirect()->route('boards.index')->with('success', 'Board updated successfully.');
    }

    public function destroy(Board $board)
    {
        abort_if($board->user_id !== Auth::id(), 403);
        $board->delete();
        return redirect()->route('boards.index')->with('success', 'Board deleted successfully.');
    }
}
