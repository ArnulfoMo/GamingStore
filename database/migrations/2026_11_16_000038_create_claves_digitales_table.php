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
        Schema::create('claves_digitales', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('producto_variante_id');
            $table->unsignedBigInteger('venta_detalle_id');
            $table->text('codigo_encriptado');
            $table->integer('estado');
            $table->dateTime('fecha_venta')->nullable();
            $table->timestamps();

            $table->foreign('producto_variante_id')
                ->references('id')
                ->on('producto_variantes')
                ->restrictOnDelete();
            $table->foreign('venta_detalle_id')
                ->references('id')
                ->on('detalle_ventas')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claves_digitales');
    }
};
