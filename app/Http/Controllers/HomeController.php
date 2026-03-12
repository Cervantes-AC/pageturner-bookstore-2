<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::with('category')
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $categories = Category::withCount('books')->get();

        return view('home', compact('featuredBooks', 'categories'));
    }
}