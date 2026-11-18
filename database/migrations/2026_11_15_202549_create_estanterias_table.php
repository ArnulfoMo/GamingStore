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
        Schema::create('estanterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->string('codigo',40);
            $table->string('pasillo',40)->nullable();
            $table->string('estante',40);
            $table->string('nivel',40)->nullable();
            $table->string('descripcion',255)->nullable();
            $table->integer('activo')->default(1);

            $table->unique(['sucursal_id','codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estanterias');
    }
};
