
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

<p align="center">
  <a href="https://travis-ci.org/laravel/framework">
    <img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# Task Management System

The **Task Management System** is a Laravel-based web application designed to streamline task assignments and tracking within organizations. Managers can assign tasks to employees under their supervision, track task progress, and manage users and departments. Employees can view and update their assigned tasks based on their roles.

---

## Features

- **Role-Based Access Control**: Distinct features for managers and employees.
- **Task Assignment**: Managers can assign tasks to employees in their departments.
- **User and Department Management**: Manage users, departments, and their associations.
- **Responsive Design**: Fully optimized for both desktop and mobile use.
- **Search and Filtering**: Filter users and tasks by department, role, or keywords.

---

## Installation

### Prerequisites

Before running this project, ensure you have:

- **PHP 8.0+**
- **Composer**
- **MySQL**
- **Node.js & npm** (optional for frontend assets)
- **Web server** (e.g., Apache or Nginx)

### Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/ahmed12348/employee-management
   cd employee-management

2. **Install dependencies**:
   composer install
    npm install

3. **set up environment variables:**: 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
4. **Migrate and seed the database:**: 

5. **Generate the application key & Run the server:**: 
php artisan key:generate
php artisan serve


**Manager**
Email: manager@example.com
Password: password

**Employee**
Email: employee@example.com
Password: password



