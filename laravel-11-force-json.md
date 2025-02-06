```bash

php artisan make:middleware ForceJsonResponse

```


`App/Http/Middleware/ForceJsonResponse.php`

```php

public function handle($request, Closure $next)
{
    $request->headers->set('Accept', 'application/json');
    return $next($request);
}

```



```php

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware
            ->append([
                ForceJsonResponse::class
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

```
