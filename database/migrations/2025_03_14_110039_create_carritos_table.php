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
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprador_id')->constrained('compradores')->onDelete('cascade'); // Relaciona el carrito con un usuario (suponiendo que tienes una tabla de usuarios)
            $table->string('producto_codigo'); // Columna para almacenar el código del producto
            $table->foreign('producto_codigo') // Define la clave foránea
                ->references('codigo') // Refleja la columna 'codigo' en la tabla 'productos'
                ->on('productos') // En la tabla productos
                ->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->foreignId('compra_id')->nullable()->constrained('compras')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
