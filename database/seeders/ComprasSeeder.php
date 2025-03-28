<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Datos para la tabla compras
        $compradores = [1, 2, 3]; // Ids de compradores, puedes cambiarlos según tus datos reales

        // Generar compras entre el 1 de enero de 2025 y el 28 de marzo de 2025
        $fechaInicio = Carbon::create(2025, 1, 1);
        $fechaFin = Carbon::create(2025, 3, 28);

        // Número de compras que quieres generar
        $numCompras = 20;

        for ($i = 0; $i < $numCompras; $i++) {
            DB::table('compras')->insert([
                'comprador_id' => $compradores[array_rand($compradores)], // Selección aleatoria del comprador entre 1 y 3
                'precio_total' => rand(50, 500) * 10, // Precio aleatorio entre 50 y 500
                'estado' => ['pendiente', 'completado', 'enviado'][array_rand(['pendiente', 'completado', 'enviado'])], // Estado aleatorio
                'fecha_compra' => $fechaInicio->copy()->addDays(rand(0, $fechaFin->diffInDays($fechaInicio))), // Fecha aleatoria entre enero y marzo de 2025
                'fecha_envio' => rand(0, 1) ? $fechaInicio->copy()->addDays(rand(1, 7)) : null, // Fecha de envío aleatoria o nula
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
