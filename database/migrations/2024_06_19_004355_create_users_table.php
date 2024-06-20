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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('socio_id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contrasenia');
            $table->rememberToken();
            $table->timestamps();

            $table->primary('username');

            $table->foreign('socio_id')
                ->references('id')->on('socios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
