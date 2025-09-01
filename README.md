# Laravel Stripe E-commerce Application

A complete e-commerce solution built with Laravel and integrated with Stripe for secure payment processing. Features a modern dashboard interface, product catalog, and seamless checkout experience.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Stripe](https://img.shields.io/badge/Stripe-626CD9?style=for-the-badge&logo=Stripe&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 🚀 Features

- ✅ **Product Catalog**: Grid-based product listing with detailed views
- ✅ **Secure Payments**: Stripe integration with Payment Methods API
- ✅ **User Authentication**: Built-in Laravel authentication
- ✅ **Responsive Design**: Mobile-first design with Tailwind CSS
- ✅ **Real-time Validation**: Client-side form validation
- ✅ **Error Handling**: Comprehensive error handling and user feedback
- ✅ **Modern UI**: Clean, professional interface with animations
- ✅ **Payment Status**: Success/failure notifications with modals
- ✅ **Security**: CSRF protection and secure payment processing

## 📋 Requirements

- **PHP** >= 8.0
- **Laravel** >= 9.0
- **Composer**
- **MySQL** or **PostgreSQL**
- **Node.js** & **NPM** (for frontend assets)
- **Stripe Account** (for payment processing)

## 🛠 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/laravel-stripe-ecommerce.git
cd laravel-stripe-ecommerce
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
npm run build
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment Variables
Edit your `.env` file with the following settings:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stripe_ecommerce
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Stripe Configuration
STRIPE_KEY=pk_test_your_stripe_publishable_key_here
STRIPE_SECRET=sk_test_your_stripe_secret_key_here
CASHIER_CURRENCY=usd

# Application URL
APP_URL=http://localhost:8000
```

### 5. Database Setup
```bash
# Run migrations
php artisan migrate

# Install Laravel Cashier
composer require laravel/cashier

# Publish Cashier migrations
php artisan vendor:publish --tag="cashier-migrations"

# Run Cashier migrations
php artisan migrate

# Seed sample products
php artisan db:seed --class=ProductSeeder
```

### 6. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 🔐 Stripe Setup

### 1. Create Stripe Account
1. Sign up at [stripe.com](https://stripe.com)
2. Activate your account
3. Navigate to **Developers** → **API keys**

### 2. Get API Keys
- **Publishable Key**: Starts with `pk_test_` (for frontend)
- **Secret Key**: Starts with `sk_test_` (for backend)

### 3. Test Cards
Use these test card numbers for development:

| Card Brand | Number | CVC | Date |
|------------|--------|-----|------|
| Visa | 4242424242424242 | Any 3 digits | Any future date |
| Visa (debit) | 4000056655665556 | Any 3 digits | Any future date |
| Mastercard | 5555555555554444 | Any 3 digits | Any future date |
| American Express | 378282246310005 | Any 4 digits | Any future date |
| Declined | 4000000000000002 | Any 3 digits | Any future date |


## 🎯 Usage

### Customer Flow
1. **Browse Products**: View products in grid layout on dashboard
2. **Select Product**: Click "Buy Now" to view product details
3. **Enter Details**: Fill in name, email, and credit card information
4. **Complete Payment**: Submit secure payment through Stripe
5. **Confirmation**: Receive success confirmation or error message

### Admin Features
- Add new products through database seeding
- View payment transactions in Stripe dashboard
- Monitor application logs for debugging

## 🔧 Configuration

### Stripe Dashboard Settings
1. **Payment Methods**: Configure accepted payment types
2. **Webhooks**: Set up event notifications (optional)
3. **Business Settings**: Add business information

### Laravel Settings
```php
// config/services.php
'stripe' => [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
],

// config/cashier.php
'currency' => env('CASHIER_CURRENCY', 'usd'),
```

### Common Issues

#### 1. "Payment failed: return_url required"
**Solution**: Disable automatic payment methods in Stripe dashboard or use the updated PaymentController code.

#### 2. "Class 'Laravel\Cashier\Billable' not found"
**Solution**: 
```bash
composer require laravel/cashier
php artisan vendor:publish --tag="cashier-migrations"
php artisan migrate
```

#### 3. "HTTPS required" warning
**Solution**: This is normal for development. Use test keys and ignore the warning, or set up HTTPS locally.

#### 4. "Stripe key not found"
**Solution**: Ensure your `.env` file has correct Stripe keys:
```env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
```

### Debugging Tips

1. **Check Laravel Logs**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Verify Stripe Configuration**:
   ```bash
   php artisan tinker
   >>> config('services.stripe.key')
   ```

3. **Test Database Connection**:
   ```bash
   php artisan migrate:status
   ```

## 🧪 Testing

### Unit Tests
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter ProductTest
```

### Manual Testing Checklist
- [ ] Products display correctly on dashboard
- [ ] Product detail page loads with payment form
- [ ] Payment form validates input
- [ ] Successful payment shows confirmation
- [ ] Failed payment shows error message
- [ ] Database records payment transactions

## 🚀 Deployment

### Production Checklist

#### 1. Environment Configuration
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Use live Stripe keys
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
```

#### 2. Security Setup
```bash
# Generate production key
php artisan key:generate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 3. Server Requirements
- ✅ **HTTPS Certificate** (required for live Stripe)
- ✅ **PHP >= 8.0**
- ✅ **Database** (MySQL/PostgreSQL)
- ✅ **Web Server** (Apache/Nginx)

### Recommended Hosting Platforms
- **Laravel Forge** + **DigitalOcean**
- **Laravel Vapor** (serverless)
- **Heroku**
- **AWS EC2**

## 📈 Performance Optimization

### Database
```bash
# Add database indexes
php artisan migrate

# Optimize database
php artisan db:optimize
```

### Caching
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

### Frontend
```bash
# Optimize assets
npm run build
```


### Documentation
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Cashier Documentation](https://laravel.com/docs/billing)
- [Stripe API Documentation](https://stripe.com/docs/api)





**Built with ❤️ using Laravel & Stripe**

### Quick Start Commands
```bash
git clone <repository-url>
cd laravel-stripe-ecommerce
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=ProductSeeder
php artisan serve
```

Visit `http://localhost:8000` and start shopping! 🛒