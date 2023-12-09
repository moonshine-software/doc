<x-page title="Socialite">

<x-p>
    For convenience, you can link your account to social networks and simplify the authentication process.
</x-p>

<x-p>
    This functionality is based on the <x-link link="https://laravel.com/docs/socialite">Laravel Socialite package</x-link>.
</x-p>

<x-p>
    Make sure you have it installed and configured.
</x-p>

<x-p>
    Next, in the MoonShine config <code>config/moonshine.php</code> install the available drivers (you should already have them configured) and the image for the button
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
    If you use your model for authentication, then you need to add the <code>HasMoonShineSocialite</code> trait to it.
</x-moonshine::alert>

</x-page>
