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
        Schema::create('productos_compras', function (Blueprint $table) {
            $table->id();
            $table->string('producto_codigo');
            $table->unsignedBigInteger('compra_id');
            $table->bigInteger('cantidad');
            $table->double('precio_total');
            $table->timestamps();

            $table->foreign('producto_codigo')->references('codigo')->on('productos')->onDelete('cascade');
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
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
