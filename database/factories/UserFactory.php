<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clear database
        User::truncate();
        Category::truncate();
        Book::truncate();

        /*
        |--------------------------------------------------------------------------
        | Admin User
        |--------------------------------------------------------------------------
        */
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('root123'),
            'role' => 'admin'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */
        User::factory(10)->create([
            'role' => 'customer'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        Category::factory(8)->create();

        /*
        |--------------------------------------------------------------------------
        | Books
        |--------------------------------------------------------------------------
        */
        Book::factory(10)->create();
    }
}