# Book Store Project

This is a Laravel-based Book Store web application.

## Prerequisites

- PHP >= 8.0
- Composer
- A database (MySQL, MariaDB, or other supported by Laravel)
- Node.js and npm (for frontend assets)

## Setup Instructions

1. Clone the repository:

```bash
git clone <repository-url>
cd book-store
```

2. Install PHP dependencies using Composer:

```bash
composer install
```

3. Copy the example environment file and configure your environment variables:

```bash
cp .env.example .env
```

Edit the `.env` file to set your database credentials and other settings.

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run database migrations:

```bash
php artisan migrate
```

6. Seed the database with books and authors data:

```bash
php artisan db:seed --class=DatabaseSeeder
```

7. Install frontend dependencies and build assets:

```bash
npm install
npm run dev
```

8. Run the development server:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`.

## Additional Notes

- To run tests:

```bash
php artisan test
```

- For production, build assets with:

```bash
npm run build
```

## Troubleshooting

- Ensure your PHP version meets the requirements.
- Check database connection settings in `.env`.
- Make sure Node.js and npm are installed for frontend asset compilation.

## License

This project is open source and available under the MIT License.
