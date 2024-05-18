<x-page title="MoonShine">

    <div style="max-width: 1440px">
        <video load="lazy" class="how-it-works-preview-video" autoplay muted preload="auto" playsinline>
            <source src="/video/moon_shine_logo_2.mp4" type="video/mp4" />
        </video>
    </div>

    <x-sub-title>Hi Laravel user!</x-sub-title>

    <x-p>
        <strong>MoonShine</strong> is an open source package for Laravel projects (MIT license)
        for accelerated development of web projects.
    </x-p>
    <x-p>
        MoonShine is great for creating admin panels, MVPs, backoffice applications, and content management systems (CMS).
    </x-p>
    <x-p>
        MoonShine is an admin panel that can be used by developers of different backgrounds.
    </x-p>
    <x-p>
        <strong>Newbies</strong> - have no problem implementing common tasks - authorization and CRUD.
        MoonShine has a low threshold for entry, it is friendly for beginners.
    </x-p>

    <x-moonshine::alert type="default" icon="heroicons.information-circle">
        MoonShine is a very handy and functional tool.
        However, to use it, you need to be confident in the basics of Laravel.
    </x-moonshine::alert>

    <x-p>
        <strong>Professionals</strong> - use all the features of Laravel without limitations,
        while getting the tools for work acceleration - "framework on framework".
    </x-p>

    <x-p>
        To suggest MoonShine or its documentation improvements, be sure to create a
        <x-link link="https://github.com/moonshine-software/moonshine/issues/new/choose">Issue on GitHub</x-link>
        with a detailed description of the idea. You’ll be very helpful to the project.
    </x-p>

    <x-sub-title>Features</x-sub-title>
    <x-p>
        <x-ul>
            <li>Using MoonShine in projects is like a designer, helping you to create the functionality much faster.</li>
            <li>There is no binding to models, you can take whatever data you like</li>
            <li>Form and table builder</li>
            <li>Lightweight and easy to use AlpineJs</li>
            <li>TailwindCSS and Blade, familiar to the vast majority of Laravel developers</li>
            <li>Ability to use Blade and Livewire components</li>
            <li>Convenient template builder, change colors and overall design</li>
        </x-ul>
    </x-p>

    <x-sub-title>History of the name</x-sub-title>
    <x-p>
        What does MoonShine stand for? It's not exactly "moonlight": my idea is the name "moonshine".
        Literally, it's the independent making of a drink under illegal conditions in the dead of night.
        So I spent my spare time (mostly at night) developing this admin panel, making a quality product with heart,
        for my own use as well as for friends. Everything is already ready for use in your projects,
        created documentation describing the order of installation, customization and features.
        I invite interested users to use and develop MoonShine together.
    </x-p>

    <x-sub-title>Where to start?</x-sub-title>
    <x-p>
        MoonShine is ready to appear in your project. Simply follow the
        <x-link link="{{ to_page('installation') }}">installation guide</x-link>,
        and then find in the documentation how to implement the required functionality and add it to your project.
    </x-p>

    <x-p>
        If you want to learn MoonShine quickly, I recommend checking out my
        <x-link :link="config('links_en.screencasts')" target="_blank">video guides</x-link>.
    </x-p>

    <x-p>
        Need help with MoonShine? You can ask a question at
        <x-link :link="config('links_en.chat')" target="_blank">Telegram chat</x-link> or
        <x-link :link="config('links_en.discord')" target="_blank">Discord chat</x-link>.
    </x-p>

    <x-image theme="light" src="{{ asset('screenshots/main.png') }}"></x-image>
    <x-image theme="dark" src="{{ asset('screenshots/main_dark.png') }}"></x-image>
</x-page>
