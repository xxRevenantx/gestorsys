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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('grado');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('generation_id');


            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete( 'cascade');

            $table->integer('sort');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
