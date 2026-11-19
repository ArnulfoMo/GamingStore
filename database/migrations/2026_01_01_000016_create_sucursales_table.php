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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();                                                  // BIGINT PK AI NN
            $table->foreignId('tienda_id')->constrained('tiendas');        // FK -> tiendas.id NN
            $table->foreignId('direccion_id')->constrained('direcciones'); // FK -> direcciones.id NN
            $table->string('nombre', 120);                                 // VARCHAR(120) NN
            $table->string('telefono', 20)->nullable();                    // VARCHAR(20) NULL
            $table->integer('activo')->default(1);                         // INT NN DEF 1
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};