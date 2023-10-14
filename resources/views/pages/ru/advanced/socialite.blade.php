<x-page title="Socialite">

<x-p>
    Для удобства можно связать аккаунт с социальными сетями и упростить процесс аутентификации.
</x-p>

<x-p>
    В основе этого функционала - <x-link link="https://laravel.com/docs/socialite">пакет Laravel Socialite</x-link>.
</x-p>

<x-p>
    Убедитесь, что он у вас установлен и настроен.
</x-p>

<x-p>
    Далее в конфиге MoonShine <code>config/moonshine.php</code> установите доступные драйверы (они уже должны быть у вас настроены) и изображение для кнопки
</x-p>

<x-code language="php">
return [
    //
    'socialite' => [
        'github' => '/images/github.png',
        'facebook' => '/images/facebook.svg'
    ]
    //
];
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если вы используете свою модель для аутентификации, то вам нужно добавить в неё трейт <code>HasMoonShineSocialite</code>.
</x-moonshine::alert>

</x-page>
