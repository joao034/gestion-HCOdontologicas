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
        Schema::table('diagnosticos', function (Blueprint $table) {
            // Eliminar la columna enfermedad_actual
            $table->dropColumn('enfermedad_actual');

            // Agregar las columnas CIE y tipo
            $table->string('CIE')->after('id')->nullable();
            $table->string('tipo')->after('CIE')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnosticos', function (Blueprint $table) {
            // Revertir los cambios si es necesario
            $table->text('enfermedad_actual')->after('id')->nullable();
            $table->dropColumn(['CIE', 'tipo']);
        });
    }
};
