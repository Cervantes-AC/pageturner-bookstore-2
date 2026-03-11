# PageTurner Bookstore - Quick Reference Guide

## 🚀 Getting Started

### Start the Application
```bash
php artisan serve
```
Access at: http://localhost:8000

### Clear Caches
```bash
php artisan optimize:clear
```

---

## 👥 User Roles & Access

### Admin Account
- **Email:** admin@pageturner.com
- **Password:** password
- **Access:** Full system control

### Customer Account
- **Register:** http://localhost:8000/register
- **Must verify email** before placing orders/reviews

---

## 🔐 Authentication Features

### Email Verification
- Required for: Orders, Reviews
- Resend link available on verification page
- Check Gmail inbox for verification email

### Password Reset
1. Click "Forgot Password" on login page
2. Enter email address
3. Check Gmail for reset link
4. Set new password

### Two-Factor Authentication (2FA)
- **Enable:** Profile → Security Settings → Enable 2FA
- **Disable:** Profile → Security Settings → Disable 2FA
- **Recovery Codes:** 8 codes generated when enabled
- **Challenge:** Enter 6-digit code sent to email during login

---

## 📧 Email Configuration

### Gmail SMTP Settings
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

### Generate Gmail App Password
1. Google Account → Security
2. Enable 2-Step Verification
3. App Passwords → Generate
4. Copy 16-character password (no spaces)
5. Update `.env` file

---

## 📊 Dashboards

### Admin Dashboard
**URL:** http://localhost:8000/admin/dashboard

**Features:**
- Total counts (Users, Books, Categories, Orders)
- Recent orders (10)
- Order status summary
- Recent reviews (5)
- Quick navigation links

### Customer Dashboard
**URL:** http://localhost:8000/customer/dashboard

**Features:**
- Welcome message
- Order summary
- Recent orders
- Review activity
- Account status (Email verified, 2FA enabled)
- Quick links

---

## 🔒 Authorization Policies

### Book Management
- **View:** Anyone
- **Create/Edit/Delete:** Admin only

### Category Management
- **View:** Anyone
- **Create/Edit/Delete:** Admin only

### Orders
- **View Own:** Customer
- **View All:** Admin
- **Update Status:** Admin only

### Reviews
- **Create:** Verified customers (must have purchased book)
- **Delete Own:** Customer
- **Delete Any:** Admin

---

## 📬 Email Notifications

### Sent to Customers
- Email verification
- Password reset
- 2FA codes
- Order placed confirmation
- Order status updates

### Sent to Admins
- New order alerts
- New review submissions

---

## 🛣️ Important Routes

### Public Routes
- `/` - Home page
- `/books` - Browse books
- `/categories` - Browse categories
- `/login` - Login
- `/register` - Register

### Authenticated Routes
- `/dashboard` - Redirects to role-specific dashboard
- `/profile` - User profile
- `/cart` - Shopping cart
- `/orders` - Order history
- `/checkout` - Checkout page

### Admin Routes
- `/admin/dashboard` - Admin dashboard
- `/admin/books/create` - Add book
- `/admin/categories/create` - Add category

### Auth Routes
- `/verify-email` - Email verification notice
- `/forgot-password` - Password reset request
- `/two-factor-challenge` - 2FA verification

---

## 🗄️ Database

### Type
SQLite (`database/database.sqlite`)

### Run Migrations
```bash
php artisan migrate
```

### Seed Database
```bash
php artisan db:seed
```

### Fresh Start
```bash
php artisan migrate:fresh --seed
```

---

## 🎨 Theme

### Color Scheme
- **Primary:** Teal (#14B8A6) to Cyan (#06B6D4)
- **Background:** Dark gradient (slate-900 to slate-800)
- **Cards:** Glassmorphism with backdrop blur
- **Text:** White/Gray on dark background

### Build Assets
```bash
npm run build
```

---

## 🧪 Testing Checklist

### As Guest
- ✅ View books and categories
- ❌ Cannot create orders
- ❌ Cannot write reviews
- ❌ Cannot access admin features

### As Customer (Unverified Email)
- ✅ Can login
- ❌ Cannot place orders
- ❌ Cannot write reviews
- Must verify email first

### As Customer (Verified Email)
- ✅ Can place orders
- ✅ Can write reviews (for purchased books)
- ✅ Can view own orders
- ✅ Can enable 2FA
- ❌ Cannot access admin features

### As Admin
- ✅ All customer features
- ✅ Create/edit/delete books
- ✅ Create/edit/delete categories
- ✅ View all orders
- ✅ Update order status
- ✅ Delete any review

---

## 🐛 Troubleshooting

### Email Not Sending
1. Check `.env` mail configuration
2. Verify Gmail App Password (no spaces)
3. Run `php artisan config:clear`
4. Check `storage/logs/laravel.log`

### "Undefined variable $slot" Error
- Clear view cache: `php artisan view:clear`
- Check Blade component syntax

### 403 Forbidden Error
- Policy authorization failed
- Check user role and permissions
- Verify logged in as correct user

### SSL Certificate Error
- Already configured to bypass for local development
- Check `app/Providers/AppServiceProvider.php`

### Routes Not Working
- Clear route cache: `php artisan route:clear`
- Check `routes/web.php` and `routes/auth.php`

---

## 📁 Key Files

### Configuration
- `.env` - Environment variables
- `config/mail.php` - Email configuration
- `config/auth.php` - Authentication settings

### Models
- `app/Models/User.php`
- `app/Models/Book.php`
- `app/Models/Order.php`
- `app/Models/Review.php`

### Controllers
- `app/Http/Controllers/BookController.php`
- `app/Http/Controllers/OrderController.php`
- `app/Http/Controllers/DashboardController.php`
- `app/Http/Controllers/TwoFactorController.php`

### Policies
- `app/Policies/BookPolicy.php`
- `app/Policies/CategoryPolicy.php`
- `app/Policies/OrderPolicy.php`
- `app/Policies/ReviewPolicy.php`

### Views
- `resources/views/dashboard/admin.blade.php`
- `resources/views/dashboard/customer.blade.php`
- `resources/views/auth/verify-email.blade.php`
- `resources/views/auth/two-factor-challenge.blade.php`

---

## 🎯 Quick Commands

```bash
# Start server
php artisan serve

# Clear all caches
php artisan optimize:clear

# View routes
php artisan route:list

# View logs
tail -f storage/logs/laravel.log

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Build frontend assets
npm run build

# Watch for changes (development)
npm run dev
```

---

## 📞 Support

For issues or questions:
1. Check `storage/logs/laravel.log`
2. Review documentation files
3. Verify `.env` configuration
4. Clear caches and try again

---

**Last Updated:** March 12, 2026  
**Version:** 1.0.0  
**Status:** Production Ready ✅
