<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_path' => $this->faker->filePath,
            'status' => 'public',
            'file_name' => $this->faker->name,
            'user_id' =>  $this->faker->numberBetween(1, User::count()),
            'number_of_downloads' => 0,
            'number_of_people' => 0,
            'description' => $this->faker->text(300),
        ];
    }
}
