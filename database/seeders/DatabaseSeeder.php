<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(WebsiteSeeder $website_seeder, UserSeeder $user_seeder, PostSeeder $post_seeder): void
    {
        $website_seeder->run();
        $user_seeder->run();
        $post_seeder->run();
    }
}
