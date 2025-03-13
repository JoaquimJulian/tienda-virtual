<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Guitarras Electricas',
                'descripcion' => 'Eléctrico',
                'imagen' => 'icono_guitarra_electrica.png',
            ],
            [
                'nombre' => 'Guitarras Españolas',
                'descripcion' => 'Acústico',
                'imagen' => 'icono_guitarra_espanola.png',
            ],
            [
                'nombre' => 'Baterias',
                'descripcion' => 'Acústico y Eléctrico',
                'imagen' => 'icono_bateria.png',
            ],
            [
                'nombre' => 'Teclados Musicales',
                'descripcion' => 'Eléctrico',
                'imagen' => 'icono_teclado_musical.png',
            ],
            [
                'nombre' => 'Pianos',
                'descripcion' => 'Acústico y Eléctrico',
                'imagen' => 'icono_piano.png',
            ],
            [
                'nombre' => 'Mesas de Mezcla',
                'descripcion' => 'Eléctrico',
                'imagen' => 'icono_mesa_mezclas.png',
            ],
            [
                'nombre' => 'Prueba',
                'descripcion' => 'Eléctrico',
                'imagen' => 'icono_mesa_mezclas.png',
            ],
        ]);
    }
}
