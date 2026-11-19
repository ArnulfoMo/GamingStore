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
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();                                        // BIGINT PK AI NN
            $table->string('nombre', 150);                       // VARCHAR(150) NN
            $table->text('descripcion')->nullable();             // TEXT NULL
            $table->integer('tipo_descuento');                   // INT NN (1 porcentaje; 2 monto fijo)
            $table->decimal('valor_descuento', 12, 2);           // DECIMAL(12,2) NN
            $table->dateTime('fecha_inicio');                    // DATETIME NN
            $table->dateTime('fecha_fin');                       // DATETIME NN
            $table->integer('activo')->default(1);               // INT NN DEF 1
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};