# Socialite 

---

Для удобства вы можете привязать свой аккаунт к социальным сетям и упростить процесс аутентификации.

Эта функциональность основана на пакете [Laravel Socialite](https://laravel.com/docs/socialite).

Убедитесь, что у вас он установлен и настроен.

Далее, в конфигурации MoonShine `config/moonshine.php` установите доступные драйверы (они уже должны быть настроены) и изображение для кнопки.

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
> Если вы используете свою модель для аутентификации, то вам нужно добавить в неё трейт `HasMoonShineSocialite`.
