<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tratamiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

   /*      DB::table('roles')->insert([
            'rol' => 'admin',
        ]);

        DB::table('roles')->insert([
            'rol' => 'odontologo',
        ]); */

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Any endodoncista',
            'email' => 'anyaguilar@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'odontologo',
        ]);

        $this->call(EspecialidadesSeeder::class);
        $this->call(SimbolosSeeder::class);
        $this->call(TratamientosSeeder::class);

    }
}
