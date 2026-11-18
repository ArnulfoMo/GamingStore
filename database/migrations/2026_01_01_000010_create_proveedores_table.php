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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();                                      // BIGINT PK AI NN
            $table->string('nombre', 150);                     // VARCHAR(150) NN
            $table->string('rtn', 20)->nullable()->unique();   // VARCHAR(20) UQ NULL
            $table->string('contacto', 120)->nullable();       // VARCHAR(120) NULL
            $table->string('telefono', 20)->nullable();        // VARCHAR(20) NULL
            $table->string('correo', 150)->nullable();         // VARCHAR(150) NULL
            $table->string('direccion', 255)->nullable();      // VARCHAR(255) NULL
            $table->integer('activo')->default(1);             // INT NN DEF 1
            $table->timestamps();                              // created_at y updated_at NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};