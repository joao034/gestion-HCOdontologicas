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
        Schema::create('odontologos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('cedula', 10)->unique();
            $table->string('sexo', 20);
            $table->unsignedBigInteger('especialidad_id');

            //llave foranea
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontologos');
    }
};
