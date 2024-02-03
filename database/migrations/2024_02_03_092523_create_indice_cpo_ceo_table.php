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
        Schema::create('indice_cpo_ceo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('odontograma_id');
            $table->foreign('odontograma_id')->references('id')->on('odontograma_cabecera');
            $table->string('tipo');
            $table->integer('caries');
            $table->integer('perdidas');
            $table->integer('obturadas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indice_cpo_ceo');
    }
};
