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
        Schema::create('abonos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('monto', 8, 2);
            
            // Foreign key
            $table->unsignedBigInteger('odontograma_detalle_id');
            $table->foreign('odontograma_detalle_id')->references('id')->on('odontograma_detalle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonos');
    }
};