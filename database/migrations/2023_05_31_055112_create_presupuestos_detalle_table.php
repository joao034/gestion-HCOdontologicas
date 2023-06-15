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
        Schema::create('presupuestos_detalle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cantidad');
            $table->float('subtotal', 8, 2);

            //llaves foraneas
            $table->foreignId('presupuesto_id')->constrained('presupuesto_cabecera');
            $table->foreignId('tratamiento_id')->constrained('tratamientos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos_detalle');
    }
};
