<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        // Ensure user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();

        $recentOrders = Order::with(['user', 'orderItems.book'])
            ->latest()
            ->take(10)
            ->get();

        $orderStatusSummary = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $recentReviews = Review::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalBooks',
            'totalCategories',
            'totalOrders',
            'recentOrders',
            'orderStatusSummary',
            'recentReviews'
        ));
    }

    public function customer()
    {
        $user = auth()->user();

        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $completedOrders = $user->orders()->where('status', 'completed')->count();

        $recentOrders = $user->orders()
            ->with(['orderItems.book'])
            ->latest()
            ->take(5)
            ->get();

        $recentPurchases = Book::whereHas('orderItems.order', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->where('status', 'completed');
        })
        ->with('category')
        ->latest()
        ->take(6)
        ->get();

        $myReviews = $user->reviews()
            ->with('book')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.customer', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'recentOrders',
            'recentPurchases',
            'myReviews'
        ));
    }
}