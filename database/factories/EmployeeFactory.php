<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fist_name'         =>fake()->firstName(),
            'last_name'         =>fake()->lastName(),
            'email'             =>fake()->email(),
            'phone'             =>fake()->numerify('##########'),
            'date_of_birth'     =>fake()->date(),
            'hire_date'         =>fake()->dateTime(),
            'salary'            =>fake()->randomFloat(2, 30000, 100000),
            'is_active'         =>rand(0,1),
            'department_id'     =>fake()->numberBetween(1000,2000),
            'manager_id'        =>fake()->numberBetween(100,200),
            'address'           =>fake()->address(),
        ];
    }
}
