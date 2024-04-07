<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('odontologo_especialidad', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('odontologo_id')->constrained('odontologos'); 
            $table->foreignId('especialidad_id')->constrained('especialidades');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odontologo_especialidad');
    }
};
