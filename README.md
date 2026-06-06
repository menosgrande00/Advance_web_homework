# Advance Web Homework

Advance Web Homework is a Laravel-based web application developed as a coursework project. The project includes user authentication, role-based admin access, category management, product management, and public product browsing pages.

## Features

- Laravel 12 application structure
- User registration and login
- Laravel Breeze authentication
- Role-based admin access
- Admin dashboard
- Category management
- Product management
- Public home page with active products
- Product detail page
- Product listing by category
- Vite and Tailwind CSS frontend setup

## Requirements

Before running the project, make sure the following tools are installed on your computer:

- PHP 8.2 or higher
- Composer
- Node.js and npm
- Git
- SQLite, MySQL, or another Laravel-supported database

The project uses PHP `^8.2` and Laravel `^12.0`.

## Installation

Clone the repository:

```bash
git clone https://github.com/menosgrande00/Advance_web_homework.git
cd Advance_web_homework
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

## Database Setup

The default `.env.example` file is configured to use SQLite:

```env
DB_CONNECTION=sqlite
```

If you want to use SQLite, create the database file:

```bash
mkdir -p database
touch database/database.sqlite
```

Then run the migrations:

```bash
php artisan migrate
```

To create the default admin user, run:

```bash
php artisan db:seed --class=AdminUserSeeder
```

Default admin login details:

```text
Email: admin@example.com
Password: 12345678
```

You can also run the general database seeder:

```bash
php artisan db:seed
```

## Running the Project

Start the Laravel development server:

```bash
php artisan serve
```

In a second terminal, start the Vite development server:

```bash
npm run dev
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

To access the admin panel, log in with the admin account and visit:

```text
http://127.0.0.1:8000/admin
```

## Building Frontend Assets

To build frontend assets for production:

```bash
npm run build
```

## Running Tests

Run the Laravel test suite with:

```bash
php artisan test
```

If you are using SQLite, make sure the SQLite database file exists and migrations have been run before testing:

```bash
mkdir -p database
touch database/database.sqlite
php artisan migrate --force
php artisan test
```

## Useful Commands

Clear Laravel cache:

```bash
php artisan optimize:clear
```

Reset and re-run migrations:

```bash
php artisan migrate:fresh
```

Reset the database and run seeders:

```bash
php artisan migrate:fresh --seed
```

Create the admin user again:

```bash
php artisan db:seed --class=AdminUserSeeder
```

## Project Structure

```text
app/Http/Controllers        Application controllers
app/Models                  Eloquent models
database/migrations         Database migration files
database/seeders            Seeder files
resources/views             Blade view files
routes/web.php              Web route definitions
public/                     Public assets
```

## Image and File Notes

If the project uses uploaded product images, make sure image paths are stored as relative paths instead of local computer paths. For example:

```text
products/image-name.jpg
```

Do not store paths like:

```text
C:/Users/YourName/Desktop/image.jpg
```

For public project images that should be visible to other people after cloning the repository, place them inside the `public` directory, for example:

```text
public/images/example.jpg
```

Then reference them in Blade using:

```php
{{ asset('images/example.jpg') }}
```

For uploaded files stored in Laravel storage, create the storage link:

```bash
php artisan storage:link
```

## License

This project was created for educational purposes.
