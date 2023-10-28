<x-page title="Аутентификации" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#extending', 'label' => 'Guard/Provider'],
        ['url' => '#form', 'label' => 'Форма'],
        ['url' => '#profile', 'label' => 'Профиль']
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    В админ-панели MoonShine реализована система аутентификации. По умолчанию она включена,
    но если нужно разрешить доступ для всех пользователей,
    то ее можно отключить в файле конфигурации <code>config/moonshine.php</code>.
</x-p>

<x-code language="php">
return [
    // ...
    'auth' => [
        'enable' => true, // [tl! focus]
        // ...
    ],
    // ...
];
</x-code>

<x-image theme="light" src="{{ asset('screenshots/login.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/login_dark.png') }}"></x-image>

<x-sub-title id="extending">Расширение возможностей</x-sub-title>

<x-p>
    Если используете собственный guard, provider, то их можно переопределить в конфигурации,
    а также модель <code>MoonshineUser</code>.
</x-p>

<x-code language="php">
return [
    // ...
    'auth' => [
        // ...
        'middleware' => Authenticate::class, // [tl! focus:start]
        'guard' => 'moonshine',
        'guards' => [
            'moonshine' => [
                'driver' => 'session',
                'provider' => 'moonshine',
            ],
        ],
        'providers' => [
            'moonshine' => [
                'driver' => 'eloquent',
                'model' => MoonshineUser::class,
            ],
        ], // [tl! focus:end]
        // ...
    ],
    // ...
];
</x-code>

<x-sub-title id="form">Форма входа</x-sub-title>

<x-p>
    Вы можете полностью заменить форму входа на собственную, просто замените класс в конфиге на свой,
    а внутри реализуйте FormBuilder
</x-p>

<x-code language="php">
return [
    // ...
    'forms' => [
        'login' => LoginForm::class
    ],
    // ...
];
</x-code>

<x-sub-title id="profile">Профиль</x-sub-title>

<x-p>
    Вы можете полностью заменить страницу профиля на собственную, просто замените класс страницы в конфиге на свой
</x-p>

<x-code language="php">
return [
    // ...
    'pages' => [
        // ...
        'profile' => ProfilePage::class
    ],
    // ...
];
</x-code>

<x-p>
    Переопределить поля для профиля можно в файле конфигурации <code>config/moonshine.php</code>.
</x-p>

<x-code language="php">
return [
    // ...
    'auth' => [
        'enable' => true,
        'fields' => [ // [tl! focus:start]
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar'
        ], // [tl! focus:end]
        'guard' => 'moonshine',
        // ...
    ],
    // ...
];
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Если вы не хотите использовать аватар,
    то укажите <code>'avatar'=>''</code> или <code>'avatar'=>false</code>.
</x-moonshine::alert>
</x-page>
