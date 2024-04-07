<?php

namespace Database\Seeders;

use App\Models\Odontologo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OdontologosSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::create([
            'name' => 'Any endodoncista',
            'email' => 'anyaguilar@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'odontologo',
        ]);

        Odontologo::create([
            'tipo_nacionalidad_id' => 1,
            'tipo_documento_id' => 1,
            'user_id' => $user->id,
            'nombres' => 'Ana',
            'apellidos' => 'Aguilar',
            'cedula' => '1802471092',
            'sexo' => 'femenino',
            'celular' => '0999999999'
        ]);
    }
}
