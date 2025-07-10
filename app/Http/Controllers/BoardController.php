<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;

class BoardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $boards = Board::where('user_id', $userId)
            ->orWhereHas('members', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();

        return view('boards.index', compact('boards'));
    }

    public function store(Request $request)
    {
        \Log::info('Authenticated user ID in store method: ' . Auth::id());
        $request->validate(['title' => 'required|string|max:255']);
        $code = Str::upper(Str::random(6));
        Board::create(array_merge($request->only('title'), ['user_id' => Auth::id(), 'code' => $code]));
        return redirect()->route('boards.index');
    }

    public function show(Board $board)
    {
        $userId = Auth::id();
        abort_if($board->user_id !== $userId && !$board->members->contains($userId), 403);
        return view('boards.show', compact('board'));
    }

    public function edit(Board $board)
    {
        $userId = Auth::id();
        abort_if($board->user_id !== $userId && !$board->members->contains($userId), 403);
        return view('boards.edit', compact('board'));
    }

    public function update(Request $request, Board $board)
    {
        $userId = Auth::id();
        abort_if($board->user_id !== $userId && !$board->members->contains($userId), 403);
        $request->validate(['title' => 'required|string|max:255']);
        $board->update($request->only('title'));
        return redirect()->route('boards.index')->with('success', 'Board updated successfully.');
    }

    public function destroy(Board $board)
    {
        $userId = Auth::id();
        abort_if($board->user_id !== $userId && !$board->members->contains($userId), 403);
        $board->delete();
        return redirect()->route('boards.index')->with('success', 'Board deleted successfully.');
    }

    public function joinByCode(Request $request)
    {
        $request->validate(['code' => 'required|string|size:6']);
        $code = strtoupper($request->input('code'));
        $board = Board::where('code', $code)->first();

        if (!$board) {
            return redirect()->route('boards.index')->withErrors(['code' => 'Board with this code not found.']);
        }

        $user = Auth::user();

        if ($board->members->contains($user->id) || $board->user_id === $user->id) {
            return redirect()->route('boards.index')->with('info', 'You are already a member of this board.');
        }

        $board->members()->attach($user->id);

        return redirect()->route('boards.show', $board)->with('success', 'Successfully joined the board.');
    }
}
