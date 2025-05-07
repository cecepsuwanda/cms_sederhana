# CMS Sederhana

A simple Content Management System built with PHP and AdminLTE.

## Features

- User Authentication
  - Login/Logout functionality
  - User roles (admin, editor, author)
  - User management

- Content Management
  - Create, edit, and delete pages
  - Rich text editor (Summernote)
  - Page status (published/draft)
  - SEO-friendly URLs (slugs)

- Admin Dashboard
  - Overview statistics
  - Recent pages list
  - Quick actions for page management

- Public Pages
  - List of published pages
  - Individual page view
  - Responsive design

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/cms_sederhana.git
cd cms_sederhana
```

2. Create a MySQL database and import the schema:
```bash
mysql -u your_username -p your_database < database.sql
```

3. Configure the database connection:
   - Copy `config/config.example.php` to `config/config.php`
   - Update the database credentials in `config/config.php`

4. Set up the web server:
   - Point the document root to the project directory
   - Make sure mod_rewrite is enabled (for Apache)

5. Set proper permissions:
```bash
chmod 755 -R .
```

## External Resources (CDN)

The project uses the following CDN resources:

- AdminLTE 3.2.0 (jsDelivr)
- Font Awesome 5.15.4 (cdnjs)
- jQuery 3.6.0 (jQuery CDN)
- Bootstrap 4.6.0 (jsDelivr)
- DataTables 1.10.25 (cdnjs)

## Default Login

- Username: admin
- Password: admin123

## File Structure

```
cms_sederhana/
├── config/
│   ├── config.php         # Configuration file
│   └── database.php       # Database connection
├── add_page.php          # Add new page
├── dashboard.php         # Admin dashboard
├── database.sql          # Database schema
├── delete_page.php       # Delete page
├── edit_page.php         # Edit page
├── index.php             # Public homepage
├── login.php             # Login page
├── logout.php            # Logout handler
├── pages.php             # Pages management
├── post.php              # Public page view
├── users.php             # User management
└── README.md             # This file
```

## Usage

### Admin Area

1. Login with admin credentials
2. Access the dashboard to see:
   - Total pages count
   - Published pages count
   - Total users count
   - Recent pages list
3. Manage pages:
   - Create new pages
   - Edit existing pages
   - Delete pages
   - Preview published pages
4. Manage users:
   - Create new users
   - Edit user details
   - Delete users
   - Assign roles

### Public Area

1. View published pages on the homepage
2. Click on page titles to read full content
3. Navigate through the site using the responsive menu

## Security

- Passwords are hashed using PHP's password_hash()
- SQL injection prevention using mysqli_real_escape_string()
- XSS prevention using htmlspecialchars()
- Session-based authentication
- Role-based access control

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
