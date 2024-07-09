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
        Schema::create('usuarios_roles', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_id');
            $table->unsignedBigInteger('rol_id');
            $table->foreign('usuario_id')
                ->references('username')->on('usuarios')
                ->onDelete('cascade');
            $table->foreign('rol_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_roles');
    }
};
