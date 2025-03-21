<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compradores')->insert([
            [
                'nombre' => 'Juan',
                'apellidos' => 'Moreno',
                'direccion' => 'Calle Mayor',
                'telefono' => '606606606',
                'email' => 'juanMoreno@gmail.com',
                'password' => '123',
                'password' => Hash::make('123')
            ],
            [
                'nombre' => 'Antonio',
                'apellidos' => 'Moreno',
                'direccion' => 'Calle Mayor',
                'telefono' => '606606606',
                'email' => 'antonioMoreno@gmail.com',
                'password' => '123',
                'password' => Hash::make('123')
            ],
            [
                'nombre' => 'Maria',
                'apellidos' => 'Moreno',
                'direccion' => 'Calle Mayor',
                'telefono' => '606606606',
                'email' => 'mariaMoreno@gmail.com',
                'password' => '123',
                'password' => Hash::make('123')
            ],
        ]);
    }
}
