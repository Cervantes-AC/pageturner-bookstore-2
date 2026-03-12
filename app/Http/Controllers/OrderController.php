<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderStatusNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->isAdmin()
            ? Order::with('user')->orderBy('created_at', 'desc')->paginate(15)
            : Order::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.book_id' => 'required|exists:books,id',
            'items.*.quantity' => 'required|integer|min:1',
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:1000',
        ]);

        // Validate items and calculate total
        $total = 0;
        $orderItems = [];

        foreach ($request->items as $item) {
            $book = Book::findOrFail($item['book_id']);

            if ($book->stock_quantity < $item['quantity']) {
                return back()->with('error', "Not enough stock for: {$book->title}");
            }

            $subtotal = $book->price * $item['quantity'];
            $total += $subtotal;

            $orderItems[] = [
                'book_id' => $book->id,
                'quantity' => $item['quantity'],
                'unit_price' => $book->price,
            ];
        }

        // Store order data in session for 2FA verification
        session([
            'pending_order' => [
                'items' => $orderItems,
                'total_amount' => $total,
                'shipping_name' => $request->shipping_name,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
            ]
        ]);

        // Redirect to 2FA verification for order
        return redirect()->route('orders.verify2fa');
    }

    public function show2FAVerification()
    {
        if (!session()->has('pending_order')) {
            return redirect()->route('cart.index')->with('error', 'No pending order found.');
        }

        // Generate and send 2FA code
        $user = auth()->user();
        $twoFactorSecret = \App\Models\TwoFactorSecret::generateForUser($user);
        $user->notify(new \App\Notifications\TwoFactorCodeNotification($twoFactorSecret->code));

        $pendingOrder = session('pending_order');
        
        return view('orders.verify-2fa', compact('pendingOrder'));
    }

    public function verify2FA(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        if (!session()->has('pending_order')) {
            return redirect()->route('cart.index')->with('error', 'No pending order found.');
        }

        $user = auth()->user();
        $code = $request->code;

        // Check if it's a recovery code
        if ($user->useRecoveryCode($code)) {
            return $this->completeOrder();
        }

        // Check 2FA code
        $twoFactorSecret = \App\Models\TwoFactorSecret::where('user_id', $user->id)
            ->where('code', $code)
            ->where('used', false)
            ->first();

        if (!$twoFactorSecret || $twoFactorSecret->isExpired()) {
            return back()->withErrors([
                'code' => 'The provided code is invalid or has expired.'
            ])->with('error', 'Invalid or expired verification code.');
        }

        // Mark code as used
        $twoFactorSecret->markAsUsed();

        return $this->completeOrder();
    }

    public function resend2FA()
    {
        if (!session()->has('pending_order')) {
            return redirect()->route('cart.index')->with('error', 'No pending order found.');
        }

        $user = auth()->user();
        
        // Generate new code
        $twoFactorSecret = \App\Models\TwoFactorSecret::generateForUser($user);
        
        // Send notification
        $user->notify(new \App\Notifications\TwoFactorCodeNotification($twoFactorSecret->code));
        
        return back()->with('success', 'A new verification code has been sent to your email.');
    }

    protected function completeOrder()
    {
        $pendingOrder = session('pending_order');
        
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $pendingOrder['total_amount'],
            'status' => 'pending',
            'shipping_name' => $pendingOrder['shipping_name'],
            'shipping_phone' => $pendingOrder['shipping_phone'],
            'shipping_address' => $pendingOrder['shipping_address'],
        ]);

        foreach ($pendingOrder['items'] as $item) {
            $order->orderItems()->create($item);
            // Reduce stock
            Book::find($item['book_id'])->decrement('stock_quantity', $item['quantity']);
        }

        // Load relationships for notifications
        $order->load(['user', 'orderItems.book']);

        // Notify customer about order placement
        $order->user->notify(new OrderStatusNotification($order));

        // Notify all admins about new order
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }

        // Clear cart and pending order
        session()->forget(['cart', 'pending_order']);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $order->load('orderItems.book');
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('updateStatus', $order);

        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        // Notify customer about status change
        $order->user->notify(new OrderStatusNotification($order, $oldStatus));

        return back()->with('success', 'Order status updated!');
    }
}