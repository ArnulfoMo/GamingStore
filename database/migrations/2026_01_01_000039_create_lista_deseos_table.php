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
        Schema::create('lista_deseos', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('producto_variante_id');
            $table->timestamp('created_at')->nullable();
            
            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
            $table->foreign('producto_variante_id')
                ->references('id')
                ->on('producto_variantes')
                ->restrictOnDelete();

            $table->unique(
                ['usuario_id', 'producto_variante_id'],
                'lista_deseos_usuario_producto_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_deseos');
    }
};
