<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // dd(Auth::user());
        return [
            'image' => null,
            'title' => $this->faker->unique()->jobTitle(),
            'content' => $this->faker->sentence(),
            'date' => $this->faker->date(),

        ];
    }
}
