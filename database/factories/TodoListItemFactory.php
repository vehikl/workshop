<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoListItem>
 */
class TodoListItemFactory extends Factory
{
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'user_id' => User::factory()
        ];
    }
}
