https://moonshine-laravel.com/docs/resource/advanced/advanced-socialite?change-moonshine-locale=en

------
## Socialite 

For convenience, you can link your account to social networks and simplify the authentication process.

This functionality is based on the [Laravel Socialite package](https://laravel.com/docs/socialite).

Make sure you have it installed and configured.

Next, in the MoonShine config `config/moonshine.php` install the available drivers (you should already have them configured) and the image for the button.

```php
return [
    //
    'socialite' => [
        'github' => '/images/github.png',
        'facebook' => '/images/facebook.svg'
    ]
    //
];
```

> [!NOTE]
> If you use your model for authentication, then you need to add the `HasMoonShineSocialite` trait to it.
