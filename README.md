# Orchid-test

## Docker Development Environment

This repository includes a complete Docker-based development environment with PHP-FPM, Nginx, MySQL, and Valkey (Redis fork) for Orchid Platform evaluation.

### Prerequisites

- Docker and Docker Compose installed on your system
- Git

### Getting Started

1. Clone this repository:
   ```
   git clone https://github.com/g-kari/Orchid-test.git
   cd Orchid-test
   ```

2. Start the Docker containers:
   ```
   docker-compose up -d
   ```

3. Access the Laravel application in your browser:
   ```
   http://localhost
   ```

4. Access the Orchid admin dashboard:
   ```
   http://localhost/admin
   ```
   Login with:
   - Email: admin@admin.com
   - Password: password

### Environment Details

- **PHP-FPM**: PHP 8.2 with common extensions required for Laravel/Orchid
- **Nginx**: Latest stable version configured to serve PHP applications
- **MySQL**: Version 8.0 with persistent storage
- **Valkey**: Redis-compatible in-memory data store

### Database Connection

- Host: `localhost` (from host) or `db` (from containers)
- Port: `3306`
- Username: `orchid`
- Password: `secret`
- Database: `orchid`

### Valkey Connection

- Host: `localhost` (from host) or `valkey` (from containers)
- Port: `6379`

### Orchid Platform

The [Orchid Platform](https://orchid.software/) is a Laravel admin panel builder that allows you to quickly create administrative applications. Key features include:

- Screen builder with reusable components
- Form builder with various field types
- Table builder with filtering and sorting
- Access control system
- CRUD operations

### Troubleshooting

If you encounter any issues:

1. Check container logs:
   ```
   docker-compose logs
   ```

2. Verify all containers are running:
   ```
   docker-compose ps
   ```

3. Restart all containers:
   ```
   docker-compose restart
   ```