<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->count(10)
            ->create()->each(function ($category) {
                $randomPosts = Post::all()->random(rand(0, 4))->pluck('id');
                $category->posts()->attach($randomPosts);
            });
    }
}
