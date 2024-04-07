<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(EspecialidadesSeeder::class);
        $this->call(SimbolosSeeder::class);
        $this->call(TratamientosSeeder::class);
        $this->call(OdontologosSeeder::class);

    }
}
