<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videojuego_genero', function (Blueprint $table) {
            $table->foreignId('videojuego_id')->constrained('videojuegos');
            $table->foreignId('genero_id')->constrained('generos');
                        
            $table->primary(['videojuegos_id','genero_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuego_genero');
    }
};
