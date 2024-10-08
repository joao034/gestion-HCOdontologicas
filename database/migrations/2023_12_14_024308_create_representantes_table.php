<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('representante', 100)->nullable();
            $table->string('cedula_representante', 16)->nullable();

            $table->unsignedBigInteger('paciente_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};
