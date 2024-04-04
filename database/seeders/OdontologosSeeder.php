<?php

namespace Database\Seeders;

use App\Models\Odontologo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OdontologosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Odontologo::create([
            'tipo_nacionalidad_id' => 1,
            'tipo_documento_id' => 1,
            'user_id' => 2,
            'nombres' => 'Ana',
            'apellidos' => 'Aguilar',
            'cedula' => '1802471092',
            'sexo' => 'femenino',
            'celular' => '0999999999'
        ]);
    }
}
