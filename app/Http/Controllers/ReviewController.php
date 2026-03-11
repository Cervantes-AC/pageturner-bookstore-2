<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use App\Notifications\NewReviewNotification;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $this->authorize('create', Review::class);

        // Check if user has purchased this book
        if (!auth()->user()->hasPurchased($book->id)) {
            return back()->with('error', 'You can only review books you have purchased.');
        }

        // Check if user already reviewed this book
        if ($book->reviews()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You have already reviewed this book.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = $book->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        // Notify all admins about new review
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewReviewNotification($review));
        }

        return back()->with('success', 'Review submitted successfully!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}