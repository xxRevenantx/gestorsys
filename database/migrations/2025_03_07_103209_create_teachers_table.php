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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personnel_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->text('funcion')->nullable();
            $table->date('ingreso_seg')->nullable();
            $table->date('ingreso_ct')->nullable();
            $table->enum('director', ['0','1'])->nullable()->default('0');
            $table->enum('extra', ['0','1'])->default('0');
            $table->string('color')->nullable();
            $table->integer('sort');


            $table->foreign('personnel_id')->references('id')->on('personnels')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
