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
        Schema::create('promocion_productos', function (Blueprint $table) {

            $table->unsignedBigInteger('promocion_id');
            $table->unsignedBigInteger('producto_variante_id');

            $table->primary(['promocion_id', 'producto_variante_id']);

            $table->foreign('promocion_id')
                ->references('id')
                ->on('promociones')
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
        Schema::dropIfExists('promocion_productos');
    }
};
