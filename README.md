Install service provider.

```php
// config/app.php
'providers' => [
    ...
    Pdffiller\LaravelSlack\LaravelSlackServiceProvider::class,
];
```

Publish config-file:

```bash
php artisan vendor:publish --provider="Pdffiller\LaravelSlack\LaravelSlackServiceProvider"
```
