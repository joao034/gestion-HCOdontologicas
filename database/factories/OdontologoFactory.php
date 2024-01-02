<?php

namespace Database\Factories;

use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Odontologo>
 */
class OdontologoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'especialidad_id' => function () {
                return Especialidad::create([
                    'nombre' => $this->faker->name,
                    'descripcion' => $this->faker->text,
                ])->id;
            },
            'user_id' => function () {
                return Factory::factoryForModel(User::class)->create()->id;
            },
            // Otros campos del odontograma
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'cedula' => $this->faker->unique()->randomLetter(10),
            'celular' => '0987654321',
            'sexo' => 'masculino',
        ];
    }
}
