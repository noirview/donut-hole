<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['unknown', 'female', 'male']);

        return [
            'name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName($gender),
            'patronymic' => $this->faker->middleName($gender),
            'gender' => $gender,
            'salary' => $this->faker->numberBetween(3, 100) * 100,
        ];
    }
}
