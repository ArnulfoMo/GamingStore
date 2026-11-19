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
        Schema::create('perfiles_gamer', function (Blueprint $table) {
            $table->id();                                                 // BIGINT PK AI NN
            $table->foreignId('user_id')->unique()->constrained('users'); // FK -> users.id UQ NN
            $table->string('gamertag', 50)->unique();                     // VARCHAR(50) UQ NN
            $table->string('telefono', 20)->nullable();                   // VARCHAR(20) NULL
            $table->date('fecha_nacimiento')->nullable();                 // DATE NULL
            $table->integer('activo')->default(0);                        // INT NN DEF 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles_gamer');
    }
};