https://moonshine-laravel.com/docs/resource/getting-started/troubleshooting?change-moonshine-locale=en

------
## Troubleshooting  

  - [Images are not displayed](#images-are-not-displayed)  
  - [Default language](#default-language)  
  - [Problems with https](#problems-with-https)  
  - [Error Page not found](#error-page-not-found)  


<a name="images-are-not-displayed"></a>  
## Images are not displayed  
- Make sure you've done `php artisan storage:link`  
- Make sure the disk is selected by default `public`, not `local`  
- Check that `APP_URL` in `.env` is correct  

```php
APP_URL=http://moonshine.test:8080
```

<a name="default-language"></a>  
## Default language  
If you have left only one language in the MoonShine config, but another language is used in the panel.

- Make sure that the Laravel config `config/app.php` specifies the same language as MoonShine  

<a name="problems-with-https"></a>  
## Problems with https  
If you have forms using url with http, but expect https:  

- Make sure you have a quality ssl certificate  
- In middleware `TrustProxies` set `protected $proxies = ['*']`  

<a name="error-page-not-found"></a>  
## Error Page not found  
- Check `config/app.php` for MoonShineServiceProvider.  
For example, the Apiato package changes its structure and MoonShine cannot be added by the provider automatically. Add it yourself  
- Make sure the resource or page is declared in `MoonShineServiceProvider`  
- Clear cache  


