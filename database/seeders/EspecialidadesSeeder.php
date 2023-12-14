<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            ['nombre' => 'Odontopediatría', 'descripcion' => 'Se encarga del cuidado de la salud bucal de los niños.'],
            ['nombre' => 'Ortodoncia', 'descripcion' => 'Se enfoca en corregir la posición de los dientes y la mandíbula.'],
            ['nombre' => 'Endodoncia', 'descripcion' => 'Trata las enfermedades y problemas de la pulpa dental.'],
            ['nombre' => 'Periodoncia', 'descripcion' => 'Diagnóstico y tratamiento de las enfermedades de las encías y los tejidos de soporte de los dientes.'],
            ['nombre' => 'Implantología', 'descripcion' => 'Se ocupa de la colocación de implantes dentales.'],
            ['nombre' => 'Odontología General', 'descripcion' => 'Diagnóstico, prevención y tratamiento de problemas dentales comunes.'],
        ];

        foreach ($especialidades as $especialidad) {
            Especialidad::create($especialidad);
        }
    }
}
