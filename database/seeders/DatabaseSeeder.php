<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::truncate();
        // Post::truncate();
        // Category::truncate();
        
       $user = User::factory()->create([
            'name' => 'John Doe',
        ]);
        Post::factory(10)->create([
            'user_id' => $user->id
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal',
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family',
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => '<p>Lorem ipsum dolar sit amet.</p>',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        //                 Voluptatem repellat esse ipsum alias natus eos amet ab mollitia voluptatibus quo cumque deleniti aliquid iusto blanditiis,  
        //                 eveniet nemo, odio porro rerum.</p>',
            
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => '<p>Lorem ipsum dolar sit amet.</p>',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        //                 Voluptatem repellat esse ipsum alias natus eos amet ab mollitia voluptatibus quo cumque deleniti aliquid iusto blanditiis,  
        //                 eveniet nemo, odio porro rerum.</p>',
            
        // ]);
    }
}
