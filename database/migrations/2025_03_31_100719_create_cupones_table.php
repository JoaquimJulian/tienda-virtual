<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponesTable extends Migration
{
    public function up()
    {
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprador_id')->constrained('compradores')->onDelete('cascade');
            $table->string('cupon', 20)->unique();
            $table->dateTime('fecha_caducidad');
            $table->enum('tipo_cupon', ['articulo_gratis', 'descuento']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cupones');
    }
}
