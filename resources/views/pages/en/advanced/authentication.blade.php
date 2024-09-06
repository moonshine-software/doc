<x-page title="Authentications" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#extending', 'label' => 'Guard/Provider'],
        ['url' => '#form', 'label' => 'Form'],
        ['url' => '#profile', 'label' => 'Profile'],
        ['url' => '#pipelines', 'label' => 'Pipelines']
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The MoonShine admin panel has an authentication system. By default it is enabled
     but if you need to allow access for all users,
     then it can be disabled in the configuration file <code>config/moonshine.php</code>.
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

<x-sub-title id="extending">Empowerment</x-sub-title>

<x-p>
    If you use your own guard, provider, then they can be overridden in the configuration,
     as well as the <code>MoonshineUser</code> model.
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

<x-sub-title id="form">Login form</x-sub-title>

<x-p>
    You can completely replace the login form with your own, just replace the class in the config with yours,
     and inside implement FormBuilder
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

<x-sub-title id="profile">Profile</x-sub-title>

<x-p>
    You can completely replace the profile page with your own, just replace the page class in the config with yours
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
    You can override profile fields in the configuration file <code>config/moonshine.php</code>.
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

<x-p>
    It is possible to change <em>Guard</em> in the Profile component.
</x-p>

<x-code language="php">
Profile::make(guard: 'custom')
</x-code>

<x-code language="php">
MoonShineAuth::guard('custom')->user()
</x-code>

<x-sub-title id="pipelines">Pipelines</x-sub-title>

<x-p>
    In the <strong>MoonShine</strong> admin panel it is possible to add logic to the authentication process,
    which will allow you to change the request or response object in the process.
</x-p>

<x-p>
    To do this, you need to specify your <em>Pipelines</em> in the configuration file <code>config/moonshine.php</code>.
</x-p>

<x-code language="php">
return [
    'auth' => [
        'pipelines' => [
            PipelineClass::class
        ],
    ]
];
</x-code>

<x-p>or</x-p>

<x-code language="php">
return [
    'auth' => [
        'pipelines' => [
            new class {
                public function handle($request, $next) {
                    return $next($request);
                }
            }
        ],
    ]
];
</x-code>

</x-page>
