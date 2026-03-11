<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determine if the user can view any reviews.
     */
    public function viewAny(?User $user): bool
    {
        // Anyone can view reviews (including guests)
        return true;
    }

    /**
     * Determine if the user can view the review.
     */
    public function view(?User $user, Review $review): bool
    {
        // Anyone can view a review
        return true;
    }

    /**
     * Determine if the user can create reviews.
     */
    public function create(User $user): bool
    {
        // Any authenticated and verified user can create reviews
        // Additional check: must have purchased the book (enforced in controller)
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine if the user can update the review.
     */
    public function update(User $user, Review $review): bool
    {
        // Users can update their own reviews
        // Admins can update any review
        return $user->id === $review->user_id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the review.
     */
    public function delete(User $user, Review $review): bool
    {
        // Users can delete their own reviews
        // Admins can delete any review
        return $user->id === $review->user_id || $user->isAdmin();
    }
}
