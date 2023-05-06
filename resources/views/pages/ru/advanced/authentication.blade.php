<x-page title="Аутентификации" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#extending', 'label' => 'Расширение возможностей'],
        ['url' => '#greetings', 'label' => 'Приветствие']
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    В админ-панели Moonshine реализована система аутентификации, которая по умолчанию включена,
    но если нужно разрешить доступ для всех пользователей,
    то ее можно отключить в файле конфигурации <code>config/moonshine.php</code>
</x-p>

<x-code language="php">
return [
// ..
'auth' => [
    // ..
    'enable' => true, // [tl! focus]
    // ..
],
// ..
</x-code>

<x-image theme="light" src="{{ asset('screenshots/login.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/login_dark.png') }}"></x-image>

<x-sub-title id="extending">Расширение возможностей</x-sub-title>

<x-p>
    Если используете собственный guard, provider, то их можно переопределить в конфигурации,
    а также модель <code>MoonshineUser</code>
</x-p>

<x-code language="php">
return [
// ..
'auth' => [
    // ..
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
    ],
    // ..
],
// ..
</x-code>

<x-p>
    Если возникает потребность добавить текст под кнопкой войти (например добавить кнопку регистрации),
    то это легко можно сделать через файл конфигурации
</x-p>

<x-code language="php">
return [
// ..
'auth' => [
    // ..
        'footer' => '<a href="https://cutcode.dev/" target="_blank">CutCode</a>'
    ],
    // ..
],
// ..
</x-code>

<x-sub-title id="greetings">Приветствие</x-sub-title>

<x-p>
    Для изменения текста приветствия на странице аутентификации
    необходимо создать языковой файл <code>lang/vendor/moonshine/ru/ui.php</code>
</x-p>

<x-code language="php">
return [
    'login' => [
        'title' => 'Добро пожаловать в :moonshine_title!',
        'description' => 'Пожалуйста, войдите в свою учетную запись',
    ],
];
</x-code>

</x-page>
