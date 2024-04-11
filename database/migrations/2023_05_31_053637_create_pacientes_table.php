<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('num_identificacion', 16)->unique(); //change in models...
            $table->string('genero', 20); //change in models...
            $table->date('fecha_nacimiento');
            $table->string('estado_civil', 30);
            $table->string('ocupacion', 50)->nullable();
            $table->string('direccion', 100);
            $table->string('celular', 10)->nullable();
            $table->string('telef_convencional', 10)->nullable();
            $table->boolean('consentimiento')->default(true);
            //considerar agregar un correo
            $table->timestamps();

            //foreing keys
            $table->unsignedBigInteger('tipo_documento_id');
            $table->unsignedBigInteger('tipo_nacionalidad_id');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
