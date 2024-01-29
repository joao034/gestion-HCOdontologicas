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
        Schema::table('odontologos', function (Blueprint $table) {
            // Campo relacionado con la tabla tipos_documento
            $table->unsignedBigInteger('tipo_documento_id')->default(1);
            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documento');

            // Campo relacionado con la tabla tipo_nacionalidad
            $table->unsignedBigInteger('tipo_nacionalidad_id')->default(1);
            $table->foreign('tipo_nacionalidad_id')->references('id')->on('tipo_nacionalidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('odontologos', function (Blueprint $table) {
            // Deshacer las relaciones
            $table->dropForeign(['tipo_documento_id']);
            $table->dropForeign(['tipo_nacionalidad_id']);

            // Eliminar los campos relacionados
            $table->dropColumn('tipo_documento_id');
            $table->dropColumn('tipo_nacionalidad_id');
        });
    }
};
