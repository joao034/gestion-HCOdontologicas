<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tratamiento;

class TratamientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tratamientos = [
            ['nombre' => 'PROFILAXIS', 'precio' => 25],
            ['nombre' => 'PROFILAXIS PROFUNDA (2 o 3 sesiones)', 'precio' => 80],
            ['nombre' => 'BLANQUEAMIENTO NORMAL', 'precio' => 120],
            ['nombre' => 'BLANQUEAMIENTO + MICROABRASION', 'precio' => 250],
            ['nombre' => 'RESINA SIMPLE', 'precio' => 20],
            ['nombre' => 'RESINA COMPUESTA', 'precio' => 25],
            ['nombre' => 'RESINA COMPLEJA', 'precio' => 30],
            ['nombre' => 'RESINA 4 PAREDES', 'precio' => 35],
            ['nombre' => 'ENDODONCIA UNIRADICULAR', 'precio' => 130],
            ['nombre' => 'ENDODONCIA BIRRADICULAR', 'precio' => 150],
            ['nombre' => 'ENDODONCIA MOLAR', 'precio' => 180],
            ['nombre' => 'RETRATAMIENTO I', 'precio' => 150],
            ['nombre' => 'RETRATAMIENTO P', 'precio' => 180],
            ['nombre' => 'RETRATAMIENTO M', 'precio' => 200],
            ['nombre' => 'PERNO DE FIBRA DE VIDRIO', 'precio' => 100],
            ['nombre' => 'EXODONCIA SIMPLE', 'precio' => 30],
            ['nombre' => 'EXODONCIA COMPLEJA', 'precio' => 40],
            ['nombre' => 'EXTRACCION DE 3ROS MOLARES SIMPLE', 'precio' => 90],
            ['nombre' => 'CIRUGIA DE 3ROS MOLARES SIMPLE', 'precio' => 110],
            ['nombre' => 'ALARGAMIENTO ANTERIOR', 'precio' => 60],
            ['nombre' => 'ALARGAMIENTO POSTERIOR', 'precio' => 70],
            ['nombre' => 'IMPLANTE REHABILITADO', 'precio' => 1200],
            ['nombre' => 'PROTESIS TOTAL 1', 'precio' => 300],
            ['nombre' => 'PROTESIS TOTAL 2', 'precio' => 400],
            ['nombre' => 'PROTESIS TOTAL 3', 'precio' => 500],
            ['nombre' => 'PROTESIS REMOVIBLE 1', 'precio' => 300],
            ['nombre' => 'PROTESIS REMOVIBLE 2', 'precio' => 400],
            ['nombre' => 'PROTESIS REMOVIBLE 3', 'precio' => 500],
            ['nombre' => 'CORONA METAL/PORCELANA', 'precio' => 190],
            ['nombre' => 'CORONA CERAMICA PURA', 'precio' => 380],
            ['nombre' => 'INCRUSTACION', 'precio' => 190],
        ];

        foreach ($tratamientos as $tratamiento) {
            Tratamiento::create($tratamiento);
        }
    }
}
