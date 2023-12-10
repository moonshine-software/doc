<x-page title="Contribution Guide" :sectionMenu="[
     'Sections' => [
         ['url' => '#dev-guide', 'label' => 'Instructions for developers'],
         ['url' => '#pr', 'label' => 'How to make a pull request'],
     ]
]">

<x-sub-title>What can I do to help?</x-sub-title>

<x-p>
    The community needs active users. You can help in many ways:
</x-p>

<x-ul :items="[
'Complementing code',
'Front-end development',
'Submit bug reports',
'Help other users understand the details',
'Supplement documentation',
'Publicize the project'
]"></x-ul>

<x-sub-title>Let's use</x-sub-title>

<x-ul :items="[
'Blade',
'TailwindCSS',
'AlpineJs',
]"></x-ul>

<x-sub-title>Where do we start?</x-sub-title>

<x-p>
    There is a product that is already functioning, fully functional and testable. Functional doesn't mean great,
    so our job is to make it better.
</x-p>

<x-sub-title>Pull requests</x-sub-title>

<x-p>
    You can suggest new features or improvements for <strong>MoonShine</strong>! Errors and bugs - all this can be fixed and sent for revision.
    I am also glad to have new specialists for open source project development.
</x-p>

<x-sub-title>Where to discuss the development?</x-sub-title>

<x-p>
    A separate chat in telegram has been created for active participants of the project. If you are ready to take part in the development,
    then join - <x-link link="https://t.me/laravel_chat/24568">MoonShine</x-link>.
</x-p>


<x-sub-title>If you find a mistake</x-sub-title>

<x-p>
    1. You have enough experience to offer a solution.
    I will be extremely glad to have your PR with a description of the error and an option to fix it.<br />
    2. If you don't know how to solve the problem - create GitHub issues and we will fix the problem soon.

</x-p>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    It is important that your pr passes all platform tests and has a detailed description,
    so that it is clear to everyone involved in the development what exactly happened.
</x-moonshine::alert>


<x-sub-title>Main branch</x-sub-title>

<x-p>
    At the moment, the main branch <code>2.x</code>
</x-p>

<x-sub-title>Coding style</x-sub-title>

<x-p>
    <strong>MoonShine</strong> adheres to PSR-12 standard and PSR-4 autoload standard.
</x-p>

<x-sub-title id="dev-guide">Instructions for developers</x-sub-title>

<x-moonshine::badge color="green">1</x-moonshine::badge> Create a directory for the project and clone the demo.

<x-code language="shell">
    git clone git@github.com:moonshine-software/demo-project.git .
</x-code>

<x-moonshine::badge color="green">2</x-moonshine::badge> Add the <code>packages</code> directory and run the command below.

<x-code language="shell">
    cd packages && git clone git@github.com:moonshine-software/moonshine.git && cd moonshine && composer install && npm install
</x-code>

<x-moonshine::badge color="green">3</x-moonshine::badge> Go back to the project directory and in <code>composer.json</code> change the moonshine/moonshine dependency.

<x-code language="shell">
    "moonshine/moonshine": "2.*.*-dev",
</x-code>

<x-moonshine::badge color="green">4</x-moonshine::badge> Add in <code>composer.json</code>.

<x-code language="shell">
"repositories": [
    {
        "type": "path",
        "url": "packages/moonshine",
        "options": {
            "versions": {
                "moonshine/moonshine": "2.*.*-dev"
            },
            "symlink": true
        }
    }
]
</x-code>

<x-moonshine::badge color="green">5</x-moonshine::badge> Create <code>.env</code> from <code>.env.example</code> (don't forget to create a database) and perform the installation below.

<x-code language="shell">
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan moonshine:user
php artisan serve
</x-code>

<x-moonshine::badge color="green">#</x-moonshine::badge> Create something useful!

<x-sub-title id="pr">How do I make a pull request?</x-sub-title>

<ul class="tree-list">
    <li>Go to the MoonShine repository and click on "Fork"</li>
    <li>Make a git clone of your fork</li>
    <li>Create a new branch for your changes</li>
    <li>Do commits relying on convention <x-link link="https://www.conventionalcommits.org">https://www.conventionalcommits.org</x-link></li>
    <li>Make push your changes to your fork</li>
    <li>Go to the MoonShine repository again and click "New pull request"</li>
    <li>Comment in detail on the changes made in the "Description" field</li>
    <li>Expect a review!</li>
</ul>

<x-sub-title>Any questions?</x-sub-title>

<x-p>
    My name is Danil! Write to me on e-mail <x-link link="mailto:thecutcode@gmail.com">thecutcode@gmail.com</x-link>
</x-p>

</x-page>
