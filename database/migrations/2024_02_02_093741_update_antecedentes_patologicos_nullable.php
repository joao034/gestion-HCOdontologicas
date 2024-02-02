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
        Schema::table('antecedentes_patologicos', function (Blueprint $table) {
            $table->string('ant_personales')->nullable()->change(); // Permitir valores nulos
            $table->string('ant_familiares')->nullable()->change(); // Permitir valores nulos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
