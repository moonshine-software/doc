<x-page title="Authentication" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#extending', 'label' => 'Extending capabilities'],
        ['url' => '#greetings', 'label' => 'Greetings']
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The Moonshine admin panel implements an authentication system that is enabled by default,
    but if you need to allow access for all users,
    you can disable it in the configuration file <code>config/moonshine.php</code>
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

<x-sub-title id="extending">Extending capabilities</x-sub-title>

<x-p>
    If you use your own guard, provider, then they can be redefined in the configuration,
    as well as the <code>MoonshineUser</code> model
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
    If there is a need to add text under the login button (for example, add a registration button),
    then this can easily be done through the configuration file
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

<x-sub-title id="greetings">Greetings</x-sub-title>

<x-p>
    To change the welcome text on the authentication page,
    you need to create a language file <code>lang/vendor/moonshine/en/ui.php</code>
</x-p>

<x-code language="php">
return [
    'login' => [
        'title' => 'Welcome to :moonshine_title!',
        'description' => 'Please sign-in to your account',
    ],
];
</x-code>

</x-page>
