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
                'nombre' => 'juan',
                'apellidos' => 'moreno',
                'direccion' => 'Calle Mayor',
                'telefono' => '606606606',
                'email' => 'juanMoreno@gmail.com',
                'password' => '123',
                'password' => Hash::make('password')
            ],
        ]);
    }
}
