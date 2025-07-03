<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['image', 'note']); // Jenis memori
            $table->text('content'); // Path gambar atau isi catatan
            $table->string('title')->nullable(); // Judul dari form "Add a Memory"
            $table->timestamps();
        });
    }
};
