<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_documento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50);
        });

        // Insertamos algunos tipos de documento de ejemplo
        DB::table('tipos_documento')->insert([
            ['nombre' => 'Cédula'],
            ['nombre' => 'DNI'],
            ['nombre' => 'Pasaporte'],
            ['nombre' => 'Visa'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_documento');
    }
};
