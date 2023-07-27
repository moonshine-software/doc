<x-page title="Authentication" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#extending', 'label' => 'Extending capabilities'],
        ['url' => '#greetings', 'label' => 'Greetings'],
        ['url' => '#profile', 'label' => 'Profile']
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

<x-sub-title id="extending">Extending capabilities</x-sub-title>

<x-p>
    If you use your own guard, provider, then they can be redefined in the configuration,
    as well as the <code>MoonshineUser</code> model
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
    If there is a need to add text under the login button (for example, add a registration button),
    then this can easily be done through the configuration file
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

<x-sub-title id="greetings">Greetings</x-sub-title>

<x-p>
    To change the welcome text on the authentication page,
    you need to create a language file <code>lang/vendor/moonshine/en/ui.php</code>
</x-p>

<x-code language="php">
return [
    // ...
    'login' => [ // [tl! focus:start]
        'title' => 'Welcome to :moonshine_title!',
        'description' => 'Please sign-in to your account',
    ], // [tl! focus:end]
    // ...
];
</x-code>

<x-sub-title id="profile">Profile</x-sub-title>

<x-p>
    You can override the fields for the profile in the configuration file <code>config/moonshine.php</code>
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
    If you don't want to use an avatar,
    then specify <code>'avatar'=>''</code> or <code>'avatar'=>false</code>.
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    If you want to change the look of your profile page,
    then create a file <code>resources/views/vendor/moonshine/profile.blade.php</code>
</x-moonshine::alert>

</x-page>
