<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        File::makeDirectory(storage_path('app/products'), $mode = 0777, true, true);

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->image('storage/app/products',640,480, null, false),
            'category_id' => Category::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'created_at' => Carbon::now()->format('Y-m-d h:m'),
        ];
    }
}
