# Set search_path / schema via Database Connection

   
You can define the `search_path` in Laravel's `config/database.php` inside the pgsql ( PostgreSQL ) connection:

```php
'pgsql' => [
    'driver'   => 'pgsql',
    'host'     => env('DB_HOST', '127.0.0.1'),
    'port'     => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset'  => 'utf8',
    'prefix'   => '',
    'schema'   => env('DB_SCHEMA', 'public'), // Set default schema
    'sslmode'  => 'prefer',
],
```


You can configure the `.env` file for different schema or skip this for default schema `public`:
```bash
DB_SCHEMA=public,demo1,demo2
```
