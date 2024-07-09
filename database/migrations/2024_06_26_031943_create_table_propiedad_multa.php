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
        Schema::create('propiedades_multas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_multa');
            $table->boolean('estado_pago');
            $table->unsignedBigInteger('propiedad_id');
            $table->unsignedBigInteger('infracion_id');

            $table->foreign('propiedad_id')
                ->references('id')->on('propiedades')
                ->onDelete('cascade');
            $table->foreign('infracion_id')
                ->references('id')->on('multas')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedades_multas');
    }
};
