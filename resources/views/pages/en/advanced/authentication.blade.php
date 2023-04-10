<x-page title="Authentication" :sectionMenu="[
    'Sections' => [
        ['url' => '#base', 'label' => 'Base'],
        ['url' => '#extension', 'label' => 'Extension scope'],
    ]
]">

<x-sub-title id="base">Base</x-sub-title>

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

<x-sub-title id="extension">Extension scope</x-sub-title>

<x-p>
    If you use your own guard, provider, then they can be overridden in the configuration,
    as well as the model <code>MoonshineUser</code>
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

</x-page>
