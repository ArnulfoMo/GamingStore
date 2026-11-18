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
        Schema::create('usuario_direcciones', function (Blueprint $table) {
            $table->id();                                                  // BIGINT PK AI NN
            $table->foreignId('usuario_id')->constrained('users');         // FK -> users.id NN
            $table->foreignId('direccion_id')->constrained('direcciones'); // FK -> direcciones.id NN
            $table->integer('principal')->default(0);                      // INT NN DEF 0

            $table->unique(['usuario_id', 'direccion_id']);                // UQ compuesto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_direcciones');
    }
};