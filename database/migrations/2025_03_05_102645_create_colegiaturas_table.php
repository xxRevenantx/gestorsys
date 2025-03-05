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
        Schema::create('colegiaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pago');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('month_id');
            $table->decimal('monto', 8, 2);
            $table->decimal('descuento', 8, 2)->nullable();
            $table->decimal('total', 8, 2);
            $table->enum('tipo_pago', ['Efectivo', 'Tarjeta', 'Transferencia']);
            $table->string('comprobante')->nullable();
            $table->string('folio');
            $table->text('observaciones')->nullable();
            $table->timestamp('fecha_pago');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colegiaturas');
    }
};
