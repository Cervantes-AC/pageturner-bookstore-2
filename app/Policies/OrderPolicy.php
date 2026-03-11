<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine if the user can view any orders.
     */
    public function viewAny(User $user): bool
    {
        // Authenticated users can view their own orders
        // Admins can view all orders
        return true;
    }

    /**
     * Determine if the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        // Users can view their own orders
        // Admins can view any order
        return $user->id === $order->user_id || $user->isAdmin();
    }

    /**
     * Determine if the user can create orders.
     */
    public function create(User $user): bool
    {
        // Any authenticated user can create orders
        // But they must have verified email (enforced by middleware)
        return true;
    }

    /**
     * Determine if the user can update the order.
     */
    public function update(User $user, Order $order): bool
    {
        // Only admins can update orders (change status)
        return $user->isAdmin();
    }

    /**
     * Determine if the user can delete the order.
     */
    public function delete(User $user, Order $order): bool
    {
        // Only admins can delete orders
        return $user->isAdmin();
    }

    /**
     * Determine if the user can update order status.
     */
    public function updateStatus(User $user, Order $order): bool
    {
        // Only admins can update order status
        return $user->isAdmin();
    }
}
