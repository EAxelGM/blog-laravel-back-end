<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(rand(10, 50));
        $slug = Str::slug($name);

        $tags = [];
        $j = rand(3,30);
        for($i=1; $i<=$j; $i++){
            $E_id = Tag::all()->random()->_id;
            if(!in_array($E_id,$tags)){
                array_push($tags, $E_id);
            }
        }
        return [
            'title' => $name,
            'subtitle' => $this->faker->realText(rand(50,300)),
            'slug' => $slug,
            'image' => 'https://picsum.photos/'.rand(550, 600),
            'category_id' => Category::all()->random()->_id,
            'tags_ids' => $tags,
            'user_id' => User::all()->random()->_id,
            'activo' => $this->faker->randomElement([1,0]),
            'status' => $this->faker->randomElement(['PUBLISHED', 'DRAFT']),
        ];
    }
}
