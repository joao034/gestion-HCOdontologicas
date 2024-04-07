<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 100);
            $table->float('precio', 8, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
