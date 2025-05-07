# CMS Sederhana

A simple Content Management System built with PHP and AdminLTE.

## Features

- User Authentication and Authorization
- Role-based Access Control (Admin, Editor, Author)
- Page Management with Rich Text Editor
- User Management
- Responsive Admin Interface
- Category Management

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web Server (Apache/Nginx)
- Composer (for dependencies)

## Installation

1. Clone or download this repository to your web server directory
2. Create a MySQL database named `cms_sederhana`
3. Import the `database.sql` file to set up the database structure
4. Configure your database connection in `config/database.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'cms_sederhana');
   ```
5. Install dependencies using Composer:
   ```bash
   # Install Composer if you haven't already
   curl -sS https://getcomposer.org/installer | php
   mv composer.phar /usr/local/bin/composer

   # Install project dependencies
   composer install
   ```
   This will automatically:
   - Download AdminLTE and all required assets
   - Set up the necessary directory structure
   - Copy all required files to their correct locations

## Directory Structure

```
cms_sederhana/
├── config/
│   └── database.php
├── public/
│   ├── plugins/
│   │   ├── fontawesome-free/
│   │   ├── jquery/
│   │   ├── bootstrap/
│   │   └── summernote/
│   └── dist/
│       ├── css/
│       └── js/
├── vendor/
├── index.php
├── login.php
├── logout.php
├── pages.php
├── users.php
├── composer.json
└── database.sql
```

## Default Login

- Username: admin
- Password: admin123

## Usage

1. Log in with the default admin credentials
2. Create and manage users with different roles
3. Create and edit pages with the rich text editor
4. Organize content with categories
5. Monitor system statistics on the dashboard

## Security

- All passwords are hashed using PHP's password_hash()
- SQL injection prevention using mysqli_real_escape_string()
- XSS prevention using htmlspecialchars()
- Session-based authentication
- Role-based access control

## License

This project is licensed under the MIT License - see the LICENSE file for details.
