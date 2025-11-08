# Troubleshooting

- [Images are not displayed](#images-are-not-displayed)
- [Problems with HTTPS](#problems-with-https)
- [Error "Page not found"](#error-page-not-found)

---

<a name="images-are-not-displayed"></a>
## Images are not displayed

- Make sure you run the command `php artisan storage:link`,
- Ensure that the default disk is set to `public`, not `local`,
- Check that `APP_URL` in the `.env` file is set correctly.

```ini
APP_URL=https://moonshine.test:8080
```

<a name="problems-with-https"></a>
## Problems with HTTPS

If you have forms that use URLs with http but expect https.

- Make sure you have a valid SSL certificate,
- In the [`TrustProxies`](https://laravel.com/docs/requests#configuring-trusted-proxies) middleware, set `protected $proxies = ['*']`.

<a name="error-page-not-found"></a>
## Error "Page not found"

- Check for the presence of `MoonShineServiceProvider` in `bootstrap/providers.php` or in `config/app.php`.
For example, the **Apiato** package changes its structure, and **MoonShine** cannot be added as a provider automatically. Add it manually,
- Ensure that the resource or page is declared in `MoonShineServiceProvider`,
- Clear the cache.
