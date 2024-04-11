<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('odontologos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombres', 50);
            $table->string('apellidos', 50); 
            $table->string('num_identificacion', 16)->unique(); //change in models...
            $table->string('celular', 10);
            $table->string('genero', 20); //change in models

            //llave foranea
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tipo_documento_id');
            $table->unsignedBigInteger('tipo_nacionalidad_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odontologos');
    }
};
