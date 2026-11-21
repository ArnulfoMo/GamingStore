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
        Schema::create('carrito_detalles', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('carrito_id');
            $table->unsignedBigInteger('producto_variante_id');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('carrito_id')
                ->references('id')
                ->on('carritos')
                ->restrictOnDelete();

            $table->foreign('producto_variante_id')
                ->references('id')
                ->on('producto_variantes')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_detalles');
    }
};
