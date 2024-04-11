<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examenes_complementarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('examenes_solicitados')->nullable();
            $table->string('tipos_examen')->nullable();
            $table->text('observaciones')->nullable();
            
            $table->unsignedBigInteger('hclinica_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examenes_complementarios');
    }
};
