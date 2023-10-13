<x-page title="Аутентификации" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#extending', 'label' => 'Расширение возможностей'],
        ['url' => '#greetings', 'label' => 'Приветствие'],
        ['url' => '#profile', 'label' => 'Профиль']
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    В админ-панели MoonShine есть встроенная система аутентификации. По умолчанию она включена,
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
        'guard' => 'moonshine', // [tl! focus:start]
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

<x-p>
    Если возникает потребность добавить текст под кнопкой "Войти" (например, добавить кнопку регистрации),
    то это легко можно сделать через файл конфигурации.
</x-p>

<x-code language="php">
return [
    // ...
    'auth' => [
        // ...
            'footer' => '<a href="https://cutcode.dev/" target="_blank">CutCode</a>' // [tl! focus]
        ],
        // ...
    ],
    // ...
];
</x-code>

<x-sub-title id="greetings">Приветствие</x-sub-title>

<x-p>
    Для изменения текста приветствия на странице аутентификации
    необходимо создать языковой файл <code>lang/vendor/moonshine/ru/ui.php</code>.
</x-p>

<x-code language="php">
return [
    // ...
    'login' => [ // [tl! focus:start]
        'title' => 'Добро пожаловать в :moonshine_title!',
        'description' => 'Пожалуйста, войдите в свою учетную запись',
    ], // [tl! focus:end]
    // ...
];
</x-code>

<x-sub-title id="profile">Профиль</x-sub-title>

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

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Если вы хотите изменить вид страницы профиля,
    то создайте файл <code>resources/views/vendor/moonshine/profile.blade.php</code>.
</x-moonshine::alert>

</x-page>
