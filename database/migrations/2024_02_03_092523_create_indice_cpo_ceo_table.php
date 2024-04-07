<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indice_cpo_ceo', function (Blueprint $table) {
            $table->id();
            
            $table->string('tipo');
            $table->integer('caries');
            $table->integer('perdidas');
            $table->integer('obturadas');
            $table->timestamps();

            $table->foreignId('odontograma_id')->constrained('odontograma_cabecera');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indice_cpo_ceo');
    }
};
