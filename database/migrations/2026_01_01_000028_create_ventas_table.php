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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales');
            $table->foreignId('direccion_id')->nullable()->constrained('direcciones');
            $table->string('numero_orden', 50)->unique();
            $table->dateTime('fecha');
            $table->integer('tipo_entrega')->default(1);
            $table->decimal('subtotal', 12, 2);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->decimal('tasa_isv', 5, 4);
            $table->decimal('ISV', 12, 2);
            $table->decimal('costo_envio', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->integer('estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
