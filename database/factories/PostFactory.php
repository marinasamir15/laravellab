<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(3),
            'description' => $this->faker->text(200),
            'user_id' => User::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(640, 480, 'abstract', true),
        ];
    }
}
