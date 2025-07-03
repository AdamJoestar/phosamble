<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- Jangan lupa import model User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan halaman profil publik pengguna.
     */
    public function show(User $user)
    {
        // Mengambil semua boards milik user tersebut, diurutkan dari yang terbaru
        $boards = $user->boards()->latest()->get();

        // Mengirim data user dan boards ke view 'users.show'
        return view('users.show', compact('user', 'boards'));
    }
}