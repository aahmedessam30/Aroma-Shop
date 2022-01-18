<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Review;
use App\Models\Comment;
use App\Models\PostCategory;
use App\Models\Prodcut;
use App\Models\Specification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Country::factory(50)->has(User::factory(1))->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Brand::factory(10)->create();
        \App\Models\PostCategory::factory(10)->create();
        \App\Models\User::factory(20)->has(Prodcut::factory(5)->has(Specification::factory(1))
        ->has(Review::factory(3)))->has(Post::factory(5)->has(Comment::factory(5)->has(Reply::factory(3))))->create();
        \App\Models\Wishlist::factory(50)->create();
    }
}
