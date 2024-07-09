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
        Schema::create('medidores', function (Blueprint $table) {
            $table->unsignedBigInteger('propiedad_id')->primary();
            $table->integer('id_medidor')->unique();
            $table->integer('medida_inicial');
            $table->integer('ultima_medida');
            $table->unsignedBigInteger('propiedades');

            $table->foreign('propiedad_id')
            ->references('id')->on('propiedades')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medidores');
    }
};
