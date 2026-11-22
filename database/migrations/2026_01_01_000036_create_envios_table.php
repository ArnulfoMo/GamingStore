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
            $table->foreignId('empresa_envio_id')->constrained('empresas_envio')->restrictOnDelete();
            $table->unsignedBigInteger('sucursal_id')->nullable();

            $table->integer('estado')->default(1);
            $table->string('numero_seguimiento', 100)->nullable()->unique();
            $table->dateTime('fecha_despacho')->nullable();
            $table->dateTime('fecha_entrega_estimada')->nullable();
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
