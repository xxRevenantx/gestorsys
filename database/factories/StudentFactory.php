<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'CURP' => $this->faker->regexify('[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}'),
            // 'nombre' => $this->faker->firstName,
            // 'apellido_paterno' => $this->faker->lastName,
            // 'apellido_materno' => $this->faker->lastName,
            // 'edad' => $this->faker->numberBetween(5, 15),
            // 'fecha_nacimiento' => $this->faker->date(),
            // 'sexo' => $this->faker->randomElement(['M', 'F']),
            // 'status' => $this->faker->randomElement(['0', '1']),
            // 'level_id' => Level::all()->random()->id,
            // 'grade_id' => Grade::all()->random()->id,
            // 'group_id' => $this->faker->numberBetween(1, 5),
            // 'generation_id' => $this->faker->numberBetween(1, 5),
            // 'tutor_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
