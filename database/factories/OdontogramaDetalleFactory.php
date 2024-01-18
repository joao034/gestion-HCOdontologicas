<?php

namespace Database\Factories;

use App\Models\Odontograma;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Simbolo;
use App\Models\Tratamiento;
use App\Models\Odontologo;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OdontogramaDetalle>
 */
class OdontogramaDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'simbolo_id' => function () {
                return Simbolo::create([
                    'nombre' => 'Simbolo 1',
                    'color' => 'rojo',
                    'ruta_imagen' => 'simbolo1.png',
                    'simbolo' => 'S',
                    'tipo' => 'realizado'
                ])->id;
            },
            'tratamiento_id' => function () {
                return Factory::factoryForModel(Tratamiento::class)->create()->id;
            },
            'odontologo_id' => function () {
                return Factory::factoryForModel(Odontologo::class)->create()->id;
            },
            'odontograma_cabecera_id' => function () {
                return Factory::factoryForModel(Odontograma::class)->create()->id;
            },

            // Otros campos del odontograma
            'num_pieza_dental' => 18,
            'fecha_realizado' => Carbon::now(),
            'precio' => 20,
            'cara_dental' => 'Vestibular',
            'observacion' => '',
            'estado' => 'necesario',
        ];
    }
}
