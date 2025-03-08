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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('CURP', 18)->unique()->nullable();
            $table->string('RFC', 13)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telefono', 10)->unique()->nullable();
            $table->string('direccion')->nullable();
            $table->string('perfil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
