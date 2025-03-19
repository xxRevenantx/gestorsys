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
            $table->unsignedBigInteger('lunes')->nullable();
            $table->unsignedBigInteger('martes')->nullable();
            $table->unsignedBigInteger('miercoles')->nullable();
            $table->unsignedBigInteger('jueves')->nullable();
            $table->unsignedBigInteger('viernes')->nullable();
            $table->timestamps();


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
