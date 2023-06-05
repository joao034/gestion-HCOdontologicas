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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('cedula', 10)->unique();
            $table->string('sexo', 20);
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('estado_civil', 30);
            $table->string('ocupacion', 50);
            $table->string('direccion', 100);
            $table->string('celular', 10)->nullable();
            $table->string('telef_convencional', 10)->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
