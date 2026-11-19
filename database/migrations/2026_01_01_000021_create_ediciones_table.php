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
        Schema::create('ediciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videojuego_id')->constrained('videojuegos');
            $table->string('nombre',100);
            $table->text('descripcion')->nullable();

            //aqui lei una que dice UQ de videojuegos y y nombre
            $table->unique(['videojuego_id','nombre']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ediciones');
    }
};
