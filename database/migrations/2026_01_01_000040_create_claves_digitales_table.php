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
            $table->unsignedBigInteger('venta_detalle_id')->nullable();

            $table->text('codigo_encriptado');
            $table->char('codigo_hash', 64)->unique();

            $table->integer('estado')->default(1);
            $table->dateTime('fecha_venta')->nullable();
            $table->dateTime('revelada_at')->nullable();

            $table->timestamp('created_at')->nullable();

            $table->foreign('producto_variante_id')
                ->references('id')
                ->on('producto_variantes')
                ->restrictOnDelete();

            $table->foreign('venta_detalle_id')
                ->references('id')
                ->on('detalle_ventas')
                ->restrictOnDelete();

            $table->index(['producto_variante_id', 'estado']);
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
