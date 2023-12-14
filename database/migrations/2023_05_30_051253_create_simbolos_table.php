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
        Schema::create('simbolos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('simbolo', 10);
            $table->string('color', 10)->nullable();
            $table->string('ruta_imagen', 100)->nullable();
            $table->string('nombre', 50);   
            $table->string('tipo', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simbolos');
    }
};
