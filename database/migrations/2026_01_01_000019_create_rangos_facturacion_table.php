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
        Schema::create('rangos_facturacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tienda_id')->constrained('tiendas');
            $table->string('cai',50);
            $table->string('rango_inicial',16);
            $table->string('rango_final',16);
            $table->string('ultimo_correlativo',16)->nullable();
            $table->date('fecha_limite')->nullable();
            $table->integer('activo')->default(1);            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rangos_facturacion');
    }
};
