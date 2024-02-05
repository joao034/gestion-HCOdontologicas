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
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropColumn('presion_arterial');
        });

        // Agregar una nueva columna del tipo string
        Schema::table('consultas', function (Blueprint $table) {
            $table->string('presion_arterial')->after('enfermedad_actual'); // Ajusta 'otra_columna_existente' según tu estructura
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropColumn('presion_arterial');
        });
    }
};
