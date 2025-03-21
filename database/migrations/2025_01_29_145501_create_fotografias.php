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
        Schema::create('fotografias', function (Blueprint $table) {
            $table->id();
            $table->string('producto_codigo');
            $table->string('nombre');
            $table->timestamps();

            $table->foreign('producto_codigo')->references('codigo')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotografias');
    }
};
