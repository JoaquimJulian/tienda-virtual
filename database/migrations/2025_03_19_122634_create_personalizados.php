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
        Schema::create('personalizados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprador_id')->constrained('compradores')->onDelete('cascade'); 
            $table->string('producto_codigo');
            $table->foreign('producto_codigo')
                ->references('codigo')
                ->on('productos')
                ->onDelete('cascade');
            $table->string('nombre_imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.a
     */
    public function down(): void
    {
        Schema::dropIfExists('personalizados');
    }
};
