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
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->year('anio_inicio');
            $table->year('anio_termino');
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('level_id')->nullable();
            $table->integer('sort');

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generations');
    }
};
