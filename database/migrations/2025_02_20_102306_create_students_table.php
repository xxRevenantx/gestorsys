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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('CURP', 18)->unique();
            $table->string('matricula', 13)->unique();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('pais_nacimiento')->nullable();
            $table->string('estado_nacimiento')->nullable();
            $table->string('municipio_nacimiento')->nullable();
            $table->string('estado_vive')->nullable();
            $table->string('municipio_vive')->nullable();
            $table->string('colonia')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('CP')->nullable();
            $table->integer('edad');
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['H', 'M']);
            $table->string('imagen')->nullable();
            $table->boolean('status');
            $table->enum('turno', ["Matutino", "Vespertino"]);
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('generation_id');
            $table->unsignedBigInteger('tutor_id')->nullable();


            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');


            $table->integer('sort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
