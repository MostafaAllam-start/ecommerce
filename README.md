
# Savemart

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://github.com/MostafaAllam-start/ecommerce/blob/master/public/assets/front/modules/novthemeconfig/images/logos/logo-1.png" width="400" alt="Laravel Logo">
  </a>
</p>

---

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Dependencies](#dependencies)
- [Scripts](#scripts)
- [License](#license)

---

## Introduction
Savemart is E-Commerce web application built using the Laravel framework. This project is designed for building scalable and robust e-commerce platforms, leveraging Laravel's extensive features for development ease and flexibility.

### Admin Dashboard
The application includes a fully-featured **admin dashboard** for managing the platform. Key functionalities include:
- Managing products, categories, and inventory.
- Monitoring sales, orders, and payments.
- Role-based access control for admins, vendors, and customers.
- Integrated analytics for sales and performance tracking.

### Multi-Role Support
The platform provides role-based access and features for:
- **Admin**: Full control of the platform, including vendor approval, user management, and global settings.
- **Vendor**: Ability to manage their own products, view orders, and track sales.
- **User/Customer**: Seamless shopping experience with features like order tracking, wishlists, and secure payments.

### Multi-Language Support
The platform supports multiple languages out of the box using `mcamara/laravel-localization`. This feature allows:
- Translating content into various languages for a global audience.
- Language switching directly in the frontend UI.
- Easy addition of new translations using JSON or PHP files.

---

## Features
- **Backend**:
  - Built with Laravel (PHP 8.2).
  - Database migrations and ORM support.
  - Integrated localization support with `mcamara/laravel-localization`.
  - Real-time data handling with Laravel's event broadcasting.
- **Frontend**:
  - Vite-based development environment.
  - Styling with TailwindCSS, Bootstrap, and Sass.
  - Modular and scalable frontend architecture.
- **Development Tools**:
  - Debugging with `barryvdh/laravel-debugbar`.
  - Testing with PHPUnit and Mockery.

---

## Installation

### Prerequisites
Ensure you have the following installed:
- PHP 8.2 or higher.
- Composer.
- Node.js and npm.
- A supported database (e.g., MySQL, SQLite).

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repository/ecommerce-master.git
   cd ecommerce-master
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Set up environment variables:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   npm run dev
   ```

---

## Usage
Start the local development server:
```bash
php artisan serve
```

Run the frontend development tools:
```bash
npm run dev
```

You can access the application at `http://localhost:8000`.

---

## Dependencies

### PHP Dependencies
- Laravel Framework 11.31
- Laravel UI (frontend scaffolding)
- Yajra DataTables
- Laravel Translatable

### Node.js Dependencies
- Vite
- TailwindCSS
- Bootstrap
- Sass
- Axios

For the full list, check the [`composer.json`](./composer.json) and [`package.json`](./package.json) files.

---

## Scripts

### npm Scripts
- `npm run dev`: Start the development server.
- `npm run build`: Build assets for production.

### Composer Scripts
- `post-create-project-cmd`: Includes commands to set up the environment and run migrations.
- `dev`: Starts development services with `concurrently`.

---

## License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
