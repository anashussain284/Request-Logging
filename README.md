## Purpose of the Project

This application is designed to log request details, including the method, URL, IP address, and response time (in milliseconds), into the database. Additionally, the project includes a Docker setup, enabling easy deployment and streamlined management of the application environment.

---

## Project Setup with Docker

Follow the steps below to run the project in Docker:

### 1. Clone the Project
Clone the project to your local machine:

```bash
git clone <repository_url>
```

### 2. Install Composer Dependencies
Navigate to the project directory and install the required Composer dependencies:

```bash
cd <project_directory>
composer install
```

### 3. Create `.env` File
Create the `.env` file from the example provided:

```bash
cp .env.example .env
```

### 4. Generate the Application Key
Generate the Laravel application key:

```bash
php artisan key:generate
```

### 5. Update Values in `Dockerfile`
Update the `WORKDIR` and `COPY` values in the `Dockerfile` to reflect the correct paths.

```dockerfile
WORKDIR /var/www/html
COPY . /var/www/html
```

### 6. Update Values in `docker-compose.yml`
Update the following values in the `docker-compose.yml` file:
- Set the correct volumes directory for your project.
- Set the Apache environment directory to the correct path.

```yaml
volumes:
  - ./path_to_your_project:/var/www/html

apache:
  environment:
    - APACHE_DOCUMENT_ROOT=/var/www/html/public
```

### 7. Update the Root Directory in `docker/apache.conf`
Update the root directory in `docker/apache.conf` to point to the `public` directory:

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    ...
</VirtualHost>
```

### 8. Create the SQLite Database File
Create the SQLite database file:

```bash
touch database/database.sqlite
```

### 9. Build the Docker Containers
Build the Docker containers:

```bash
docker-compose build
```

### 10. Start the Containers
Start the Docker containers in detached mode:

```bash
docker-compose up -d
```

### 11. Access the Container
Access the application container:

```bash
docker-compose exec app bash
```

### 12. Check Apache Server Configuration
Ensure the Apache server configuration is correct:

```bash
apachectl configtest
```

### 13. Set Proper Permissions and Ownership
Give proper permissions and ownership to the necessary directories:

```bash
chmod -R 775 bootstrap/cache storage
chown -R www-data:www-data bootstrap/cache storage
chmod 775 database
chown -R www-data:www-data database
chmod 664 database/database.sqlite
chown www-data:www-data database/database.sqlite
```

### 14. Run Migrations
Run the Laravel migrations to set up the database:

```bash
php artisan migrate
```

### 15. Access the Application
Access the application at:

```bash
http://localhost:8080/
```

---

## Request Log Middleware Toggle

The request log middleware can be enabled or disabled by following these steps:

### 1. Enable Request Logging
To enable request logging, update the `.env` file as follows:

```env
ENABLE_REQUEST_LOGGING=true
```

### 2. Disable Request Logging
To disable request logging, update the `.env` file as follows:

```env
ENABLE_REQUEST_LOGGING=false
```

### 3. Clear and Rebuild Configuration Cache
After modifying the `.env` file, clear and rebuild the configuration cache to apply the changes:

```bash
php artisan config:clear
php artisan config:cache
```
---

## Technologies Used

The following technologies and tools are used in this project:

- **Laravel**: A PHP framework for building web applications.
- **SQLite**: A lightweight database for storing application data.
- **Docker**: For containerizing the application and managing environments.
- **Apache**: A web server for hosting the application.
- **Composer**: Dependency management for PHP.
- **PHP 8.2**: The programming language used to develop the application.

---

## Contributors

We would like to thank the following individuals for their contributions to this project:

- **[Anas Hussain M](https://github.com/anashussain284)** - Project development, Docker setup, and middleware implementation.