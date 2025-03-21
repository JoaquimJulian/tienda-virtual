<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electricas = [
            ['nombre' => 'Stratocaster', 'precio' => 1200.50, 'stock' => 10, 'destacado' => true],
            ['nombre' => 'Les Paul', 'precio' => 1500.00, 'stock' => 8, 'destacado' => false],
            ['nombre' => 'SG', 'precio' => 1400.75, 'stock' => 12, 'destacado' => true],
            ['nombre' => 'Telecaster', 'precio' => 1300.25, 'stock' => 9, 'destacado' => false],
            ['nombre' => 'Flying V', 'precio' => 1600.90, 'stock' => 7, 'destacado' => true],
            ['nombre' => 'Explorer', 'precio' => 1550.30, 'stock' => 6, 'destacado' => false],
        ];

        foreach ($electricas as $index => $electrica) {
            $codigo = 'GU' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($electrica['nombre'], 0, 2));
            
            DB::table('productos')->insert([
                'codigo' => $codigo,
                'nombre' => $electrica['nombre'],
                'descripcion' => 'Guitarra eléctrica modelo ' . $electrica['nombre'] . ' de alta calidad.',
                'categoria_id' => 1,
                'precio_unidad' => $electrica['precio'],
                'stock' => $electrica['stock'],
                'destacado' => $electrica['destacado'],
                'imagen_principal' => 'imagen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $espanolas = [
            ['nombre' => 'Alhambra', 'precio' => 900.00, 'stock' => 15, 'destacado' => true],
            ['nombre' => 'Ramirez', 'precio' => 1100.50, 'stock' => 12, 'destacado' => false],
            ['nombre' => 'Yamaha C40', 'precio' => 450.75, 'stock' => 20, 'destacado' => true],
            ['nombre' => 'Cordoba C5', 'precio' => 700.25, 'stock' => 18, 'destacado' => false],
            ['nombre' => 'Admira', 'precio' => 650.90, 'stock' => 14, 'destacado' => true],
            ['nombre' => 'Esteve', 'precio' => 800.30, 'stock' => 10, 'destacado' => false],
        ];

        foreach ($espanolas as $index => $espanola) {
            $codigo = 'ES' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($espanola['nombre'], 0, 2));
            
            DB::table('productos')->insert([
                'codigo' => $codigo,
                'nombre' => $espanola['nombre'],
                'descripcion' => 'Guitarra española modelo ' . $espanola['nombre'] . ' de alta calidad.',
                'categoria_id' => 2,
                'precio_unidad' => $espanola['precio'],
                'stock' => $espanola['stock'],
                'destacado' => $espanola['destacado'],
                'imagen_principal' => 'imagen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $baterias = [
            ['nombre' => 'Yamaha Stage Custom', 'precio' => 1800.00, 'stock' => 5, 'destacado' => true],
            ['nombre' => 'Pearl Export', 'precio' => 1400.50, 'stock' => 7, 'destacado' => false],
            ['nombre' => 'Tama Imperialstar', 'precio' => 1600.75, 'stock' => 6, 'destacado' => true],
            ['nombre' => 'Ludwig Classic Maple', 'precio' => 2500.25, 'stock' => 4, 'destacado' => false],
            ['nombre' => 'Gretsch Catalina', 'precio' => 2000.90, 'stock' => 5, 'destacado' => true],
            ['nombre' => 'Mapex Armory', 'precio' => 1300.30, 'stock' => 8, 'destacado' => false],
        ];

        foreach ($baterias as $index => $bateria) {
            $codigo = 'BA' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($bateria['nombre'], 0, 2));
            
            DB::table('productos')->insert([
                'codigo' => $codigo,
                'nombre' => $bateria['nombre'],
                'descripcion' => 'Batería modelo ' . $bateria['nombre'] . ' de alta calidad.',
                'categoria_id' => 3,
                'precio_unidad' => $bateria['precio'],
                'stock' => $bateria['stock'],
                'destacado' => $bateria['destacado'],
                'imagen_principal' => 'imagen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $teclados = [
            ['nombre' => 'Yamaha PSR-E373', 'precio' => 300.00, 'stock' => 20, 'destacado' => true],
            ['nombre' => 'Casio CTK-3500', 'precio' => 250.00, 'stock' => 18, 'destacado' => false],
            ['nombre' => 'Roland GO:KEYS', 'precio' => 400.75, 'stock' => 15, 'destacado' => true],
            ['nombre' => 'Korg EK-50', 'precio' => 500.25, 'stock' => 12, 'destacado' => false],
            ['nombre' => 'Alesis Harmony 61', 'precio' => 280.90, 'stock' => 14, 'destacado' => true],
            ['nombre' => 'Nord Stage 3', 'precio' => 3000.30, 'stock' => 5, 'destacado' => false],
        ];

        foreach ($teclados as $index => $teclado) {
            $codigo = 'TE' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($teclado['nombre'], 0, 2));
            
            DB::table('productos')->insert([
                'codigo' => $codigo,
                'nombre' => $teclado['nombre'],
                'descripcion' => 'Teclado musical modelo ' . $teclado['nombre'] . ' de alta calidad.',
                'categoria_id' => 4,
                'precio_unidad' => $teclado['precio'],
                'stock' => $teclado['stock'],
                'destacado' => $teclado['destacado'],
                'imagen_principal' => 'imagen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $pianos = [
            ['nombre' => 'Yamaha P-125', 'precio' => 600.00, 'stock' => 10, 'destacado' => true],
            ['nombre' => 'Casio Privia PX-160', 'precio' => 500.00, 'stock' => 8, 'destacado' => false],
            ['nombre' => 'Roland FP-30X', 'precio' => 700.50, 'stock' => 12, 'destacado' => true],
            ['nombre' => 'Korg B2', 'precio' => 450.25, 'stock' => 6, 'destacado' => false],
            ['nombre' => 'Alesis Recital Pro', 'precio' => 350.90, 'stock' => 15, 'destacado' => true],
            ['nombre' => 'Nord Piano 5', 'precio' => 2500.30, 'stock' => 3, 'destacado' => false],
        ];
        
        foreach ($pianos as $index => $piano) {
            $codigo = 'PI' . str_pad(1, 3, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($piano['nombre'], 0, 2));
            
            DB::table('productos')->insert([
                'codigo' => $codigo,
                'nombre' => $piano['nombre'],
                'descripcion' => 'Piano digital modelo ' . $piano['nombre'] . ' de alta calidad.',
                'categoria_id' => 5,
                'precio_unidad' => $piano['precio'],
                'stock' => $piano['stock'],
                'destacado' => $piano['destacado'],
                'imagen_principal' => 'imagen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $mesas_de_mezcla = [
            ['nombre' => 'Behringer Xenyx 1202', 'precio' => 100.00, 'stock' => 25, 'destacado' => true],
            ['nombre' => 'Yamaha MG10XU', 'precio' => 250.00, 'stock' => 15, 'destacado' => false],
            ['nombre' => 'Mackie Mix8', 'precio' => 150.75, 'stock' => 20, 'destacado' => true],
            ['nombre' => 'Soundcraft Notepad-8FX', 'precio' => 200.00, 'stock' => 12, 'destacado' => false],
            ['nombre' => 'Allen & Heath ZED-10', 'precio' => 400.90, 'stock' => 8, 'destacado' => true],
            ['nombre' => 'PreSonus StudioLive AR8c', 'precio' => 600.30, 'stock' => 5, 'destacado' => false],
        ];
        
        foreach ($mesas_de_mezcla as $index => $mesa) {
            $codigo = 'ME' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($mesa['nombre'], 0, 2));
            
            DB::table('productos')->insert([
                'codigo' => $codigo,
                'nombre' => $mesa['nombre'],
                'descripcion' => 'Mesa de mezcla modelo ' . $mesa['nombre'] . ' de alta calidad.',
                'categoria_id' => 6, 
                'precio_unidad' => $mesa['precio'],
                'stock' => $mesa['stock'],
                'destacado' => $mesa['destacado'],
                'imagen_principal' => 'imagen.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        DB::table('productos')->insert([
            [
                'codigo' => 'BA000-BP',
                'nombre' => 'Bombo Personalizable',
                'descripcion' => 'Bombo personalizable al gusto del cliente',
                'categoria_id' => 3, 
                'precio_unidad' => 499.99,
                'stock' => 0,
                'destacado' => 0,
                'imagen_principal' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
