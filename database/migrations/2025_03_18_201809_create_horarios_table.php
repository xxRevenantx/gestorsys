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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('hora');  // Hora de la clase
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('lunes')->nullable();
            $table->unsignedBigInteger('martes')->nullable();
            $table->unsignedBigInteger('miercoles')->nullable();
            $table->unsignedBigInteger('jueves')->nullable();
            $table->unsignedBigInteger('viernes')->nullable();

            $table->timestamps();


            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('set null');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            $table->foreign('lunes')->references('id')->on('materias')->onDelete('set null');
            $table->foreign('martes')->references('id')->on('materias')->onDelete('set null');
            $table->foreign('miercoles')->references('id')->on('materias')->onDelete('set null');
            $table->foreign('jueves')->references('id')->on('materias')->onDelete('set null');
            $table->foreign('viernes')->references('id')->on('materias')->onDelete('set null');





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
