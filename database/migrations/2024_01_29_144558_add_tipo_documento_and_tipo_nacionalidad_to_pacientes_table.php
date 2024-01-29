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
        Schema::table('pacientes', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_documento_id')->default(1);
            $table->unsignedBigInteger('tipo_nacionalidad_id')->default(1);

            // Definir la clave foránea
            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documento');
            $table->foreign('tipo_nacionalidad_id')->references('id')->on('tipo_nacionalidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropForeign(['tipo_documento_id']);
            $table->dropColumn('tipo_documento_id');
        });
    }
};
