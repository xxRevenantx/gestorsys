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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->string('CURP', 18)->unique()->nullable();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('calle')->nullable();
            $table->string('num_ext')->nullable();
            $table->string('num_int')->nullable();
            $table->string('localidad')->nullable();
            $table->string('colonia')->nullable();
            $table->string('CP', 10)->nullable();
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 10)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('parentesco')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('ultimo_grado')->nullable();
            $table->integer('sort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
