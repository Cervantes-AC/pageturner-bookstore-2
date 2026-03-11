<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Determine if the user can view any books.
     */
    public function viewAny(?User $user): bool
    {
        // Anyone can view books (including guests)
        return true;
    }

    /**
     * Determine if the user can view the book.
     */
    public function view(?User $user, Book $book): bool
    {
        // Anyone can view a single book
        return true;
    }

    /**
     * Determine if the user can create books.
     */
    public function create(User $user): bool
    {
        // Only admins can create books
        return $user->isAdmin();
    }

    /**
     * Determine if the user can update the book.
     */
    public function update(User $user, Book $book): bool
    {
        // Only admins can update books
        return $user->isAdmin();
    }

    /**
     * Determine if the user can delete the book.
     */
    public function delete(User $user, Book $book): bool
    {
        // Only admins can delete books
        return $user->isAdmin();
    }

    /**
     * Determine if the user can restore the book.
     */
    public function restore(User $user, Book $book): bool
    {
        // Only admins can restore books
        return $user->isAdmin();
    }

    /**
     * Determine if the user can permanently delete the book.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        // Only admins can force delete books
        return $user->isAdmin();
    }
}
