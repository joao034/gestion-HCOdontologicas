<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Simbolo;

class SimbolosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $simbolos = [
            ['simbolo' => '*', 'color' => '', 'ruta_imagen' => 'sellante_n.png', 'nombre' => 'Sellante necesario', 'tipo' => 'necesario'],
            ['simbolo' => '*', 'color' => '', 'ruta_imagen' => 'sellante_r.png', 'nombre' => 'Sellante realizado', 'tipo' => 'realizado'],
            ['simbolo' => 'X', 'color' => '', 'ruta_imagen' => 'extraccion_n.png', 'nombre' => 'Extracción necesaria', 'tipo' => 'necesario'],
            ['simbolo' => 'X', 'color' => '', 'ruta_imagen' => 'extraccion_r.png', 'nombre' => 'Extracción realizada', 'tipo' => 'realizado'],
            ['simbolo' => '▲', 'color' => '', 'ruta_imagen' => 'endodoncia_n.png', 'nombre' => 'Endodoncia necesaria', 'tipo' => 'necesario'],
            ['simbolo' => '▲', 'color' => '', 'ruta_imagen' => 'endodoncia_r.png', 'nombre' => 'Endodoncia realizada', 'tipo' => 'realizado'],
            ['simbolo' => '●', 'color' => '', 'ruta_imagen' => 'caries_n.png', 'nombre' => 'Caries', 'tipo' => 'necesario'],
            ['simbolo' => '●', 'color' => '', 'ruta_imagen' => 'caries_r.png', 'nombre' => 'Obturación realizada', 'tipo' => 'realizado'],
            ['simbolo' => 'C', 'color' => '', 'ruta_imagen' => 'corona_n.png', 'nombre' => 'Corona', 'tipo' => 'necesario'],
            ['simbolo' => 'C', 'color' => '', 'ruta_imagen' => 'corona_r.png', 'nombre' => 'Corona', 'tipo' => 'realizado'],
            ['simbolo' => 'I', 'color' => '', 'ruta_imagen' => 'implante_n.png', 'nombre' => 'Implante', 'tipo' => 'necesario'],
            ['simbolo' => 'I', 'color' => '', 'ruta_imagen' => 'implante_r.png', 'nombre' => 'Implante', 'tipo' => 'realizado'],
            ['simbolo' => 'i', 'color' => '', 'ruta_imagen' => 'incrustacion_n.png', 'nombre' => 'Incrustación', 'tipo' => 'necesario'],
            ['simbolo' => 'i', 'color' => '', 'ruta_imagen' => 'incrustacion_r.png', 'nombre' => 'Incrustación', 'tipo' => 'realizado'],
            ['simbolo' => 'ss', 'color' => '#3243a6', 'ruta_imagen' => '', 'nombre' => 'Restauración realizada', 'tipo' => 'realizado'],
            ['simbolo' => 'ss', 'color' => '#dc3545', 'ruta_imagen' => '', 'nombre' => 'Restauración necesaria', 'tipo' => 'necesario'],
        ];

        foreach ($simbolos as $simbolo) {
            Simbolo::create($simbolo);
        }
    }
}
