<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name(),
            'apellidos' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date(),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'telef_convencional' => '2432424',
            'celular' => '0992580757',
            'direccion' => $this->faker->address(),
            'cedula' => '1851005361',
            'edad' => $this->faker->numberBetween(1, 100),
            'estado_civil' => $this->faker->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']),
            'ocupacion' => $this->faker->jobTitle(),
        ];
    }
}
