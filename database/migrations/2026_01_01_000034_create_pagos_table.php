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
            
            $table->foreignId('metodo_pago_id')->constrained('metodos_pago')->restrictOnDelete();
            $table->decimal('monto', 12, 2);
            $table->integer('estado')->default(1);
            $table->string('referencia_transaccion', 150)->nullable();
            $table->dateTime('fecha_pago')->nullable();
            
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
