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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users');
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->string('identidad',14)->unique();
            $table->string('primer_nombre',60);
            $table->string('segundo_nombre',60)->nullable();
            $table->string('primer_apellido',60);
            $table->string('segund_apellido',60)->nullable();
            $table->string('cargo',80);
            $table->decimal('salario',12,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
