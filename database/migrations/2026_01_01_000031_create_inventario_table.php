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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId('producto_variante_id')->constrained('producto_variantes');
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(0);
            $table->foreignId('estanteria_id')->nullable()->constrained('estanterias');
            $table->unique(['sucursal_id', 'producto_variante_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
