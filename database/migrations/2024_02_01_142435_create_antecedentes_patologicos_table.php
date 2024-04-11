<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antecedentes_patologicos', function (Blueprint $table) {
            $table->id();
            $table->string('ant_personales')->nullable();
            $table->text('desc_personales')->nullable();
            $table->string('ant_familiares')->nullable();
            $table->text('desc_familiares')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('hclinica_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antecedentes_patologicos');
    }
};
