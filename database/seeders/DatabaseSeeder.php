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
        User::truncate();
        Category::truncate();
        Book::truncate();

        /*
        |--------------------------------------------------------------------------
        | Admin User
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('root123'),
            'role' => 'admin'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        Category::create(['name' => 'Action']);
        Category::create(['name' => 'Fantasy']);
        Category::create(['name' => 'Adventure']);

        /*
        |--------------------------------------------------------------------------
        | Sample Books (3 Only)
        |--------------------------------------------------------------------------
        */

        Book::create([
            'category_id' => 1,
            'title' => 'Bleach Volume 1',
            'author' => 'Tite Kubo',
            'isbn' => '9781234500001',
            'price' => 10,
            'stock_quantity' => 20,
            'description' => 'Story of Soul Reapers and spiritual warfare.'
        ]);

        Book::create([
            'category_id' => 1,
            'title' => 'Naruto Volume 1',
            'author' => 'Masashi Kishimoto',
            'isbn' => '9781234500002',
            'price' => 12,
            'stock_quantity' => 25,
            'description' => 'Ninja adventure story of Naruto Uzumaki.'
        ]);

        Book::create([
            'category_id' => 2,
            'title' => 'Dragon Ball Volume 1',
            'author' => 'Akira Toriyama',
            'isbn' => '9781234500003',
            'price' => 11,
            'stock_quantity' => 30,
            'description' => 'Classic martial arts and adventure manga.'
        ]);
    }
}