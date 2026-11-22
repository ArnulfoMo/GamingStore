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
        Schema::create('empresas_envio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 254)->nullable();
            $table->string('sitio_web', 255)->nullable();
            $table->integer('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas_envio');
    }
};
