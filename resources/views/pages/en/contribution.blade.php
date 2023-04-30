<x-page title="Contribution Guide" :sectionMenu="[
     'Sections' => [
         ['url' => '#dev-guide', 'label' => 'Developers guide'],
         ['url' => '#pr', 'label' => 'How to make a pull request'],
     ]
]">

<x-sub-title>What can you do to help?</x-sub-title>

<x-p>
    The community needs active users. You can help in many ways
</x-p>

<x-ul :items="[
'Front-end code',
'Front-end development',
'Submit bug reports',
'Help other users understand the details',
'Take care of writing documentation',
'Doing advocacy'
]"></x-ul>

<x-sub-title>We are using a technology stack</x-sub-title>

<x-ul :items="[
'Blade',
'Tailwindcss',
'AlpineJs',
]"></x-ul>

<x-sub-title>Where do we start?</x-sub-title>

<x-p>
There is already a functioning product, fully functional and testable. Working doesn't mean great, so the goal is to make the project just that.
</x-p>

<x-sub-title>Pull requests</x-sub-title>

<x-p>
    You can suggest new features or improvements to MoonShine! Bugs and bugs - all this can be fixed and sent for improvement.
    I'm also glad to meet new open source project development specialists
</x-p>

<x-sub-title>Where to discuss development?</x-sub-title>

<x-p>
    For active participants in the project created a separate chat in telegram, if you are ready to participate in the development, then join - <x-link link="https://t.me/laravel_chat/24568">MoonShine</x-link>.
</x-p>


<x-sub-title>If you found a mistake</x-sub-title>

<x-p>
    1. You have enough experience to offer a solution.
    I would be very happy to receive your PR with a description of the error and a way to fix it.
    <br>
    2. If you don't know how to solve the problem, create github issues and we will fix the problem soon.

    <div class="text-sm my-4">* It is important that your pr passed all the tests of the platform and had a detailed description, so that all participants in the development was clear what exactly happened.</div>
</x-p>

<x-sub-title>Main branch</x-sub-title>

<x-p>
    At the moment, the main branch is <code>1.5.x</code>
</x-p>

<x-sub-title>Coding style</x-sub-title>

<x-p>
    MoonShine adheres to the PSR-12 standard and PSR-4 autoload standard.
</x-p>

<x-sub-title id="dev-guide">Developer's guide</x-sub-title>

<x-moonshine::badge color="green">1</x-moonshine::badge> Make project dir and clone demo project

<x-code language="shell">
    git clone git@github.com:moonshine-software/demo-project.git .
</x-code>

<x-moonshine::badge color="green">2</x-moonshine::badge> Add packages folder and execute command

<x-code language="shell">
    cd packages && git clone git@github.com:moonshine-software/moonshine.git && cd moonshine && composer install && npm install
</x-code>

<x-moonshine::badge color="green">3</x-moonshine::badge> Back to the root and remove moonshine/moonshine dependency from composer.json

<x-code language="shell">
    "moonshine/moonshine": "^1.50",
</x-code>

<x-moonshine::badge color="green">3</x-moonshine::badge> Add MoonShine to autoload section in composer.json

<x-code language="shell">
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/",
        "MoonShine\\": "packages/moonshine/src"
    }
},
</x-code>

<x-moonshine::badge color="green">4</x-moonshine::badge> Add vendor MoonShineServiceProvider to config/app.php

<x-code language="php">
use App\Providers\MoonShineServiceProvider;
// Import vendor provider
use MoonShine\Providers\MoonShineServiceProvider as MSProvider;

// ..

/*
* Package Service Providers...
*/
// Add vendor provider
MSProvider::class,

// ..
</x-code>

<x-moonshine::badge color="green">5</x-moonshine::badge> Make and configure .env (don't forget to create a database) and install

<x-code language="shell">
composer require lee-to/laravel-package-command && composer require rap2hpoutre/fast-excel &&  composer install && npm install
</x-code>

<x-code language="shell">
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan moonshine:user
php artisan serve
</x-code>

<x-moonshine::badge color="green">#</x-moonshine::badge> Make something great

<x-sub-title id="pr">How to make a pull request?</x-sub-title>
<x-ul :items="[
'Fork the MoonShine official repository',
'Clone your forked repository to your local machine.',
'Create a new branch for your changes/feature.',
'Make your changes and commit them with descriptive commit messages. Use https://www.conventionalcommits.org',
'Push your changes to your forked repository on the new branch.',
'Go to the original repository (MoonShine) and create a new pull request.',
'Describe the changes you made and explain why they are valuable.',
'Wait for review',
]"></x-ul>

<x-sub-title>Questions?</x-sub-title>

<x-p>
    My name is Danil! Email me at <x-link link="mailto:thecutcode@gmail.com">thecutcode@gmail.com</x-link>
</x-p>

</x-page>
