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
        Schema::create('producto_variantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('plataforma_id')->nullable()->constrained('plataformas');
            $table->foreignId('edicion_id')->nullable()->constrained('ediciones');
            $table->string('sku', 80)->unique();
            $table->string('codigo_barras', 100)->nullable();
            $table->string('nombre_variante', 150)->nullable();
            $table->integer('formato');
            $table->decimal('precio', 12, 2);
            $table->date('fecha_disponibilidad')->nullable();
            $table->integer('activo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_variantes');
    }
};
