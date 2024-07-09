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
        Schema::create('consumos', function (Blueprint $table) {
            $table->unsignedBigInteger('propiedad_id')->primary();
            $table->integer('consumo_total');
            $table->date('mes_correspondiente');
            $table->timestamps();

            $table->foreign('propiedad_id')
                ->references('propiedad_id')->on('medidores')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumos');
    }
};
