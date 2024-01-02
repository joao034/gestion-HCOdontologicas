<?php

namespace Database\Factories;

use App\Models\Paciente; // Import the Paciente class
use Illuminate\Database\Eloquent\Factories\Factory; // Import the Factory class

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Odontograma>
 */
class OdontogramaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paciente_id' => function () {
                return Factory::factoryForModel(Paciente::class)->create()->id; 
            },
            // Otros campos del odontograma
            'fecha_creacion' => now()->format('Y-m-d'),
            'total' => 0,
        ];
    }
}
