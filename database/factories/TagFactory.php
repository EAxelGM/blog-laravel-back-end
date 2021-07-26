<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText(50, 5);
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'user_id' => User::all()->random()->_id,
            'activo' => $this->faker->randomElements([1,0]),
        ];
    }
}
