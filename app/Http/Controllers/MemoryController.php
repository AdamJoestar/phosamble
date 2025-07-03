<?php

namespace App\Http\Controllers;

// app/Http/Controllers/MemoryController.php
use App\Models\Board;
use Illuminate\Http\Request;

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
            'user_id' => auth()->id(),
            'type' => $type,
            'title' => $request->title,
            'content' => $content,
        ]);

        return back()->with('success', 'Memory added!');
    }
}