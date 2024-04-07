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
            $table->string('cedula', 16)->unique();
            $table->string('celular', 10);
            $table->string('sexo', 20);

            //llave foranea
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tipo_documento_id')->default(1);
            $table->unsignedBigInteger('tipo_nacionalidad_id')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odontologos');
    }
};
