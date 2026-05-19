<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


### Brett Laguerra - 5/19/2026

## Tech Stack

- PHP 8.3
- Laravel 11
- MariaDB
- Eloquent ORM
- Laravel Breeze (Authentication)
- Tailwind CSS

### Setup Instructions

## Prerequisites

- PHP 8.3+
- Composer
- Node.js & npm
- MariaDB

## Installation

1. Clone the repository:

```bash
git clone git@github.com:yourusername/your-repo.git
cd your-repo

```

2. Install PHP dependencies:

```bash
composer install

```

3. Install frontend dependencies:

```bash
npm install

```

4. Copy the environment file and configure it:

```bash
cp .env.example .env
php artisan key:generate

```

5. Update `.env` with your database credentials

6. Create the database in MariaDB:

```sql
CREATE DATABASE your_database;

```

7. Run migrations and seed the database:

```bash
php artisan migrate --seed

```

8. Build frontend assets:

```bash
npm run build

```

9. Start the development server:

```bash
php artisan serve

```

10. Visit `http://localhost:8000`, register an account, and start using the application.


### Features

## Core

- **Item Management** — Full CRUD for products with name, SKU, description, price, and inventory tracking
- **Customer Management** — Full CRUD for customers with contact and address information
- **Shopping Cart** — Add items, update quantities, remove items, clear cart
- **Sales Orders** — Create orders from cart, select customer, automatic price snapshots and tax calculation
- **Dashboard** — Summary view with item/customer counts and recent orders

## Bonus

- **Search & Filter** — Search items by name/SKU, customers by name/email, orders by number/customer
- **Pagination** — All list views paginated at 15 records per page
- **Authentication** — Full login/register system via Laravel Breeze
- **Inventory Awareness** — Stock levels displayed with color indicators, out-of-stock items cannot be added to cart, quantities decrement on checkout with stock validation

## Design Decisions

- **Separate users and customers**: Users are people who log into the system. Customers are who orders are placed for. This supports a scenario where staff manage orders on behalf of customers.
- **Price snapshots on order lines**: The `unit_price` on order lines captures the price at the time of purchase. If item prices change later, historical orders remain accurate.
- **CartService class**: Business logic for cart operations is extracted into a service class to keep controllers thin and logic reusable/testable.
- **DB transactions on checkout**: The entire checkout process is wrapped in a database transaction to ensure data integrity — if any step fails, everything rolls back.
- **Soft stock validation**: Stock is checked both when adding to cart and again at checkout to handle race conditions where stock may have changed.

## What I Would Improve Given More Time

- Create unit testing for CRUD operations and checkout flow
- Create order management for status
- Allow user to print customer, item, or orders to a CSV
- Get user feedback about the flow and alter accordingly
- Overhaul the look of the application to feel more customized
- Implement real-time cart updates
- Send email notifications for orders and/or inventory(if stock is below a threshold)
