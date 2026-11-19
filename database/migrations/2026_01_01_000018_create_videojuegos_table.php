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
        Schema::create('videojuegos', function (Blueprint $table) {
            $table->id();                                              // BIGINT PK AI NN
            $table->string('nombre', 180);                             // VARCHAR(180) NN
            $table->text('descripcion')->nullable();                   // TEXT NULL
            $table->string('portada', 255)->nullable();                // VARCHAR(255) NULL
            $table->string('trailer', 255)->nullable();                // VARCHAR(255) NULL
            $table->json('requisitos_tecnicos')->nullable();           // JSON NULL
            $table->date('fecha_lanzamiento')->nullable();             // DATE NULL
            $table->integer('es_preventa')->default(0);                // INT NN DEF 0
            $table->foreignId('clasificacion_esrb_id')
                  ->constrained('clasificaciones_esrb');               // FK -> clasificaciones_esrb.id NN
            $table->integer('activo')->default(1);                     // INT NN DEF 1
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuegos');
    }
};