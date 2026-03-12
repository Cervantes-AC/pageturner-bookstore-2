# 2FA for Order Placement - Implementation Guide

## Overview

Every order placement now requires Two-Factor Authentication (2FA) verification. This adds an extra layer of security to prevent unauthorized purchases.

## How It Works

### Customer Flow

1. **Add items to cart** → Browse and add books
2. **Proceed to checkout** → Fill shipping information
3. **Submit order** → Order data stored in session
4. **Receive 2FA code** → 6-digit code sent to email
5. **Verify code** → Enter code on verification page
6. **Order confirmed** → Order created and notifications sent

### Security Features

- ✅ 6-digit verification code
- ✅ Code expires in 10 minutes
- ✅ One-time use codes
- ✅ Recovery code support
- ✅ Resend code option
- ✅ Session-based order storage
- ✅ Stock validation before and after verification

## User Experience

### Checkout Page
- Shows security notice about 2FA requirement
- Displays user's email address
- Button text: "Continue to Verification" (instead of "Place Order")

### Verification Page
- Clean, focused interface
- Order summary display
- Large code input field
- Auto-format for 6 digits
- Resend code button
- Recovery code option
- Cancel and go back option

### After Verification
- Order created immediately
- Stock reduced
- Notifications sent (email + database + toast)
- Cart cleared
- Redirect to order details

## Technical Implementation

### Routes

```php
// Order placement flow
POST   /orders                      → Store order data in session
GET    /orders/verify/2fa           → Show 2FA verification page
POST   /orders/verify/2fa           → Verify code and complete order
POST   /orders/verify/2fa/resend    → Resend verification code
```

### Session Data

Order data stored in session during verification:

```php
session([
    'pending_order' => [
        'items' => [...],           // Order items with book_id, quantity, unit_price
        'total_amount' => 1234.56,  // Total order amount
        'shipping_name' => '...',   // Customer name
        'shipping_phone' => '...',  // Phone number
        'shipping_address' => '...', // Full address
    ]
]);
```

### Controller Methods

**OrderController.php**

1. `store()` - Validates order, stores in session, redirects to 2FA
2. `show2FAVerification()` - Generates code, sends email, shows form
3. `verify2FA()` - Validates code, completes order
4. `resend2FA()` - Generates new code, sends email
5. `completeOrder()` - Creates order, reduces stock, sends notifications

## Code Examples

### Generating 2FA Code

```php
$twoFactorSecret = TwoFactorSecret::generateForUser($user);
$user->notify(new TwoFactorCodeNotification($twoFactorSecret->code));
```

### Verifying Code

```php
$twoFactorSecret = TwoFactorSecret::where('user_id', $user->id)
    ->where('code', $code)
    ->where('used', false)
    ->first();

if (!$twoFactorSecret || $twoFactorSecret->isExpired()) {
    return back()->withErrors(['code' => 'Invalid or expired code']);
}

$twoFactorSecret->markAsUsed();
```

### Using Recovery Code

```php
if ($user->useRecoveryCode($code)) {
    return $this->completeOrder();
}
```

## Email Notification

When user submits order, they receive an email with:
- 6-digit verification code
- Order total amount
- Expiration time (10 minutes)
- Security notice

## Security Considerations

### Prevents

- ✅ Unauthorized purchases
- ✅ Session hijacking attacks
- ✅ Accidental orders
- ✅ Bot/automated purchases

### Validates

- ✅ User has access to registered email
- ✅ User intends to make purchase
- ✅ Stock availability (twice - before and after verification)
- ✅ Code hasn't been used
- ✅ Code hasn't expired

## Error Handling

### Invalid Code
```
"The provided code is invalid or has expired."
```
- User can request new code
- User can use recovery code
- User can cancel and go back

### Expired Session
```
"No pending order found."
```
- Redirects to cart
- User must restart checkout process

### Stock Issues
```
"Not enough stock for: [Book Title]"
```
- Checked before storing in session
- Checked again after verification
- Prevents overselling

## Testing

### Test Order with 2FA

1. **As Customer:**
   ```
   - Add books to cart
   - Go to checkout
   - Fill shipping info
   - Click "Continue to Verification"
   - Check email for code
   - Enter code
   - Order confirmed
   ```

2. **Test Invalid Code:**
   ```
   - Enter wrong code
   - See error message
   - Request new code
   - Enter correct code
   - Order confirmed
   ```

3. **Test Recovery Code:**
   ```
   - Click "Use recovery code instead"
   - Enter recovery code
   - Order confirmed
   ```

4. **Test Resend:**
   ```
   - Click "Resend Code"
   - Check email for new code
   - Enter new code
   - Order confirmed
   ```

### Manual Testing Commands

```bash
# Check pending orders in session
php artisan tinker
>>> session()->get('pending_order')

# Check 2FA codes
>>> App\Models\TwoFactorSecret::latest()->first()

# Clear session
>>> session()->forget('pending_order')
```

## Customization

### Change Code Expiration Time

Edit `app/Models/TwoFactorSecret.php`:

```php
public function isExpired()
{
    return $this->created_at->addMinutes(10)->isPast(); // Change 10 to desired minutes
}
```

### Change Code Length

Edit `app/Models/TwoFactorSecret.php`:

```php
public static function generateForUser($user)
{
    $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT); // Change 6 to desired length
    // ...
}
```

### Disable 2FA for Orders (Not Recommended)

To disable 2FA requirement:

1. Remove 2FA routes from `routes/web.php`
2. Restore original `OrderController::store()` method
3. Update checkout button text

## Files Modified/Created

### Created Files
- `resources/views/orders/verify-2fa.blade.php` - Verification page

### Modified Files
- `app/Http/Controllers/OrderController.php` - Added 2FA methods
- `routes/web.php` - Added 2FA routes
- `resources/views/cart/checkout.blade.php` - Added security notice

## User Notifications

### Email Sent
1. **2FA Code Email** - When order submitted
2. **Order Confirmation Email** - After verification
3. **Order Status Updates** - When admin changes status

### Toast Notifications
1. **Code Sent** - "Verification code sent to your email"
2. **Code Resent** - "A new verification code has been sent"
3. **Invalid Code** - "Invalid or expired verification code"
4. **Order Placed** - "Order placed successfully!"

## Troubleshooting

### Code Not Received
1. Check spam/junk folder
2. Verify email address is correct
3. Click "Resend Code"
4. Use recovery code if available

### Session Expired
1. Go back to cart
2. Restart checkout process
3. Complete within 10 minutes

### Stock Changed During Verification
1. System validates stock again after verification
2. If insufficient, order fails with error
3. User must adjust cart and retry

## Best Practices

1. **Complete verification quickly** - Codes expire in 10 minutes
2. **Keep recovery codes safe** - Store in secure location
3. **Use correct email** - Ensure email address is up to date
4. **Check spam folder** - Codes may be filtered
5. **Don't share codes** - Codes are single-use and personal

## Future Enhancements

- SMS-based 2FA option
- Authenticator app support (TOTP)
- Biometric verification
- Remember device option
- Configurable 2FA requirement (per user preference)
- Admin bypass option for trusted customers

## Support

If users have issues with 2FA:
1. Verify email address in profile
2. Check email spam/junk folder
3. Use recovery code option
4. Contact support for assistance
5. Admin can manually create order if needed

---

**Security Note:** This 2FA implementation significantly enhances order security and prevents unauthorized purchases. All customers must verify their identity before completing orders.
