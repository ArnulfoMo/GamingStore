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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('sucursal_id');

            $table->integer('estado');
            $table->string('numero_seguimiento', 100);
            $table->dateTime('fecha_despacho')->nullable();
            $table->dateTime('fecha_entrega')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('venta_id')
                ->references('id')
                ->on('ventas')
                ->restrictOnDelete();
            $table->foreign('sucursal_id')
                ->references('id')
                ->on('sucursales')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
