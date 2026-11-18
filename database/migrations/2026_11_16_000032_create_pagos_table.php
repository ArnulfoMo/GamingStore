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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            
            $table->integer('tipo_pago');
            $table->decimal('monto',10,2);
            $table->integer('estado');
            $table->string('referencia_transaccion', 150);
            $table->dateTime('fecha_pago');
            
            $table->foreign('venta_id')
                  ->references('id')
                  ->on('ventas')
                  ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
