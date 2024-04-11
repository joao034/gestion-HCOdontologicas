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
            $table->integer('caries')->default(0);
            $table->integer('perdidas')->default(0);
            $table->integer('obturadas')->default(0);
            $table->timestamps();

            $table->foreignId('odontograma_id')->constrained('odontograma_cabecera');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indice_cpo_ceo');
    }
};
