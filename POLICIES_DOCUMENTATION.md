# Policy-Based Authorization Documentation

## Overview
This document describes the Laravel Policy-based authorization system implemented for the PageTurner Bookstore application.

## Implemented Policies

### 1. BookPolicy (`app/Policies/BookPolicy.php`)

**Purpose:** Controls access to book management operations

**Authorization Rules:**
- `viewAny()` - Anyone (including guests) can view books list
- `view()` - Anyone can view a single book
- `create()` - Only admins can create books
- `update()` - Only admins can update books
- `delete()` - Only admins can delete books
- `restore()` - Only admins can restore soft-deleted books
- `forceDelete()` - Only admins can permanently delete books

**Usage in Controller:**
```php
// BookController.php
public function create()
{
    $this->authorize('create', Book::class);
    // ...
}

public function update(Request $request, Book $book)
{
    $this->authorize('update', $book);
    // ...
}
```

---

### 2. CategoryPolicy (`app/Policies/CategoryPolicy.php`)

**Purpose:** Controls access to category management operations

**Authorization Rules:**
- `viewAny()` - Anyone can view categories list
- `view()` - Anyone can view a single category
- `create()` - Only admins can create categories
- `update()` - Only admins can update categories
- `delete()` - Only admins can delete categories
- `restore()` - Only admins can restore soft-deleted categories
- `forceDelete()` - Only admins can permanently delete categories

**Usage in Controller:**
```php
// CategoryController.php
public function create()
{
    $this->authorize('create', Category::class);
    // ...
}

public function destroy(Category $category)
{
    $this->authorize('delete', $category);
    // ...
}
```

---

### 3. OrderPolicy (`app/Policies/OrderPolicy.php`)

**Purpose:** Controls access to order operations

**Authorization Rules:**
- `viewAny()` - Authenticated users can view their orders; admins can view all
- `view()` - Users can view their own orders; admins can view any order
- `create()` - Any authenticated user can create orders (email verification enforced by middleware)
- `update()` - Only admins can update orders
- `delete()` - Only admins can delete orders
- `updateStatus()` - Only admins can update order status

**Usage in Controller:**
```php
// OrderController.php
public function show(Order $order)
{
    $this->authorize('view', $order);
    // ...
}

public function updateStatus(Request $request, Order $order)
{
    $this->authorize('updateStatus', $order);
    // ...
}
```

---

### 4. ReviewPolicy (`app/Policies/ReviewPolicy.php`)

**Purpose:** Controls access to review operations

**Authorization Rules:**
- `viewAny()` - Anyone can view reviews
- `view()` - Anyone can view a single review
- `create()` - Only authenticated users with verified email can create reviews
- `update()` - Users can update their own reviews; admins can update any review
- `delete()` - Users can delete their own reviews; admins can delete any review

**Additional Business Logic:**
- Users can only review books they have purchased (enforced in controller)
- Users can only submit one review per book (enforced in controller)

**Usage in Controller:**
```php
// ReviewController.php
public function store(Request $request, Book $book)
{
    $this->authorize('create', Review::class);
    
    // Additional check: must have purchased the book
    if (!auth()->user()->hasPurchased($book->id)) {
        return back()->with('error', 'You can only review books you have purchased.');
    }
    // ...
}

public function destroy(Review $review)
{
    $this->authorize('delete', $review);
    // ...
}
```

---

## How Policies Work

### 1. Policy Registration
Laravel automatically discovers policies based on naming conventions:
- `Book` model → `BookPolicy`
- `Category` model → `CategoryPolicy`
- `Order` model → `OrderPolicy`
- `Review` model → `ReviewPolicy`

### 2. Authorization Methods

**In Controllers:**
```php
// Authorize before action
$this->authorize('update', $book);

// Authorize with class name (for create)
$this->authorize('create', Book::class);
```

**In Blade Views:**
```blade
@can('update', $book)
    <a href="{{ route('books.edit', $book) }}">Edit</a>
@endcan

@can('delete', $book)
    <form method="POST" action="{{ route('books.destroy', $book) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endcan
```

**In Routes:**
```php
Route::middleware('can:update,book')->group(function () {
    // Protected routes
});
```

### 3. Response to Unauthorized Access
When authorization fails:
- Returns HTTP 403 Forbidden error
- Can be customized in `app/Exceptions/Handler.php`
- Shows "This action is unauthorized" message by default

---

## Security Benefits

1. **Centralized Authorization Logic**
   - All access control rules in one place per model
   - Easy to maintain and update

2. **Consistent Enforcement**
   - Same rules applied across controllers, views, and routes
   - Prevents authorization bypass

3. **Role-Based Access Control**
   - Admin vs. Customer permissions clearly defined
   - Owner-based permissions (users can only modify their own content)

4. **Email Verification Integration**
   - Reviews require verified email
   - Orders require verified email (via middleware)

5. **Audit Trail**
   - Clear documentation of who can do what
   - Easy to review security requirements

---

## Testing Policies

### Manual Testing Checklist

**As Guest (Not Logged In):**
- ✅ Can view books and categories
- ❌ Cannot create/edit/delete books
- ❌ Cannot create/edit/delete categories
- ❌ Cannot access orders
- ❌ Cannot create reviews

**As Customer (Logged In, Email Verified):**
- ✅ Can view books and categories
- ✅ Can create orders
- ✅ Can view own orders
- ✅ Can create reviews (for purchased books)
- ✅ Can delete own reviews
- ❌ Cannot create/edit/delete books
- ❌ Cannot create/edit/delete categories
- ❌ Cannot view other users' orders
- ❌ Cannot update order status

**As Admin:**
- ✅ Can do everything customers can do
- ✅ Can create/edit/delete books
- ✅ Can create/edit/delete categories
- ✅ Can view all orders
- ✅ Can update order status
- ✅ Can delete any review

---

## Integration with Existing Features

### Middleware Stack
```
Authentication → Email Verification → Policy Authorization → Controller Action
```

### Example Flow: Creating a Review
1. User must be authenticated (`auth` middleware)
2. User must have verified email (`verified` middleware)
3. Policy checks if user can create reviews (`ReviewPolicy::create`)
4. Controller checks if user purchased the book (business logic)
5. Controller checks if user already reviewed the book (business logic)
6. Review is created and admin is notified

---

## Best Practices Implemented

1. ✅ Policies for all major resources (Book, Category, Order, Review)
2. ✅ Guest access allowed where appropriate (viewing public content)
3. ✅ Owner-based permissions (users can modify their own content)
4. ✅ Admin override (admins can perform all actions)
5. ✅ Integration with email verification
6. ✅ Clear separation of concerns (authorization vs. business logic)
7. ✅ Consistent authorization checks across all controllers

---

## Conclusion

The policy-based authorization system provides enterprise-grade access control for the PageTurner Bookstore application. All authorization rules are centralized, maintainable, and consistently enforced across the application.
