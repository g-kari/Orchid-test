# Orchid Platform Evaluation

This is an evaluation setup for [Orchid Platform](https://orchid.software), a Laravel Admin Panel builder that allows you to create administrative applications with minimal effort.

## Features

- **Admin Dashboard**: Access at `/admin`
- **User Management**: Create, edit, and manage users with role-based permissions
- **Form Builder**: Create and manage forms with various field types
- **Table Builder**: Display and manage data in tables with sorting and filtering
- **Screen Management**: Organize your admin interface into screens
- **CRUD Operations**: Easily create, read, update and delete operations

## Setup

The project has been set up in a Docker environment with PHP-FPM, Nginx, MySQL, and Valkey (Redis fork).

### Login Credentials

To access the Orchid admin dashboard:

- **URL**: http://localhost/admin
- **Email**: admin@admin.com
- **Password**: password

## Sample Screen

A sample screen has been created to demonstrate Orchid's functionality:

- **URL**: http://localhost/admin/sample
- **Features**: 
  - Form with various field types
  - Save and Cancel buttons
  - Form validation
  - Toast notifications

## Development

To further develop this application:

1. Add new screens in the `app/Orchid/Screens` directory
2. Register the screens in the `routes/platform.php` file
3. Add menu items in the `app/Orchid/PlatformProvider.php` file

## Documentation

For more information on how to use Orchid Platform, refer to the official documentation:

- [Orchid Documentation](https://orchid.software/en/docs)
- [Laravel Documentation](https://laravel.com/docs)

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
