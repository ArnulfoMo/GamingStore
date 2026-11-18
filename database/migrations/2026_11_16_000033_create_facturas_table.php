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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('rango_facturacion_id');

            $table->string('numero_factura', 30);
            $table->string('CAI', 50);
            $table->string('RTN_emisor', 20);
            $table->string('RTN_cliente', 20);
            $table->decimal('subtotal', 12, 2);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->decimal('tasa_isv', 5, 4);
            $table->decimal('ISV', 12, 2);
            $table->decimal('total', 12, 2);
            $table->dateTime('fecha_emision');
            $table->integer('estado');

            $table->foreign('venta_id')
                ->references('id')
                ->on('ventas')
                ->restrictOnDelete();
            $table->foreign('rango_facturacion_id')
                ->references('id')
                ->on('rango_facturacion')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};