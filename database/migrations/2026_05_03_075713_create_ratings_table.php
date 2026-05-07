<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('photo_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('score'); // 1-5
            $table->timestamps();
            
            // Prevent duplicate ratings
            $table->unique(['user_id', 'photo_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};