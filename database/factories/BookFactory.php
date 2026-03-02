<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => 1,
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'isbn' => '0000000000000',
            'price' => 10,
            'stock_quantity' => 10,
            'description' => 'Sample description',
            'cover_image' => null
        ];
    }
}