<x-page title="Socialite">

<x-p>
    For convenience, you can link the account to social networks and simplify the authentication process
</x-p>

<x-p>
    The process is based on a Laravel package - Socialite
</x-p>

<x-link link="https://laravel.com/docs/socialite">Socialite</x-link>

<x-p>
    Make sure you have it installed and configured
</x-p>

<x-p>
    Next, in the moonshine config <code>config/moonshine.php</code> install the available drivers (you should already have them set up) and the image for the button
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
    If you use your model for authentication, then you need to add the trait <code>HasMoonShineSocialite</code> to it
</x-moonshine::alert>

</x-page>
