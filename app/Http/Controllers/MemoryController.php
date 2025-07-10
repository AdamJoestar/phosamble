<?php

namespace App\Http\Controllers;

// app/Http/Controllers/MemoryController.php
use App\Models\Board;
use App\Models\Memory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemoryController extends Controller
{
    public function store(Request $request, Board $board)
    {
        // Validasi
        $request->validate([
            'title' => 'nullable|string',
            'story' => 'nullable|string',
            'media' => 'required_without:story|image|mimes:jpeg,png,jpg,gif|max:2048', // Wajib ada gambar jika tidak ada story
        ]);

        $type = $request->hasFile('media') ? 'image' : 'note';
        $content = '';

        if ($type === 'image') {
            // Simpan gambar dan dapatkan path-nya
            $path = $request->file('media')->store('memories', 'public');
            $content = $path;
        } else {
            $content = $request->story;
        }

        $board->memories()->create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'type' => $type,
            'title' => $request->title,
            'content' => $type === 'note' ? null : $content,
            'story' => $request->story,
        ]);

        return back()->with('success', 'Memory added!');
    }

    public function edit(Board $board, Memory $memory)
    {
        return view('boards.edit-memory', compact('board', 'memory'));
    }

    public function update(Request $request, Board $board, Memory $memory)
    {
        $request->validate([
            'title' => 'nullable|string',
            'story' => 'nullable|string',
            'media' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $memory->title = $request->title;
        $memory->story = $request->story;

        if ($request->hasFile('media')) {
            // Hapus file lama jika ada
            if ($memory->content) {
                Storage::disk('public')->delete($memory->content);
            }
            // Simpan file baru
            $path = $request->file('media')->store('memories', 'public');
            $memory->content = $path;
            $memory->type = 'image';
        }

        $memory->save();

        return redirect()->route('boards.show', $board)->with('success', 'Memory updated!');
    }

    public function destroy(Board $board, Memory $memory)
    {
        if ($memory->content) {
            Storage::disk('public')->delete($memory->content);
        }
        $memory->delete();

        return redirect()->route('boards.show', $board)->with('success', 'Memory deleted!');
    }
}
