<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EspecialidadesSeeder::class,
            SimbolosSeeder::class,
            TratamientosSeeder::class,
            OdontologosSeeder::class
        ]);
    }
}
