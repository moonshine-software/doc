<x-page title="MoonShine">

    <div style="max-width: 1440px">
        <video load="lazy" class="how-it-works-preview-video" autoplay muted preload="auto" playsinline>
            <source src="/video/moon_shine_logo_2.mp4" type="video/mp4" />
        </video>
    </div>

    <x-sub-title>Hi Laravel user!</x-sub-title>

    <x-p>
        <strong>MoonShine</strong> is an open source package for open source Laravel projects (MIT license)
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
        MoonShine has a low entry threshold and is beginner friendly.
    </x-p>

    <x-moonshine::alert type="default" icon="heroicons.information-circle">
        MoonShine is a very handy and functional tool.
        However, to use it, you need to be confident in the basics of Laravel.
    </x-moonshine::alert>

    <x-p>
        <strong>Professionals</strong> - use all the features of Laravel without limitations,
        while getting the tools to speed up your work - "framework on framework".
    </x-p>

    <x-p>
        To suggest MoonShine improvements or documentation, be sure to create a
        <x-link link="https://github.com/moonshine-software/moonshine/issues/new/choose">Issue on GitHub</x-link> with a detailed description of the idea.
        You will help the project a lot.
    </x-p>

    <x-sub-title>Features</x-sub-title>
    <x-p>
        <ul>
            <li>Using MoonShine in projects is like a designer, helping you create the functionality you need much faster.</li>
            <li>There is no binding to models, you can take whatever data you like</li>
            <li>Form and table builder</li>
            <li>Lightweight and easy to use AlpineJs</li>
            <li>TailwindCSS and Blade, familiar to the vast majority of Laravel developers</li>
            <li>Ability to use Blade and Livewire components</li>
            <li>Convenient template builder, change colors and overall design</li>
        </ul>
    </x-p>

    <x-sub-title>History of the name</x-sub-title>
    <x-p>
        What does MoonShine stand for? It's not exactly "moonlight": my idea of it is the name "moonshine".
        Literally, it's the independent making of a drink under illegal conditions under the cover of night.
        So I spent nights in my spare time (mostly at night) developing this admin panel,
        making a quality product with heart, for my own use. Well, and for friends.
        Everything is already ready for use in your projects, created documentation describing the order of installation,
        customization and features. I suggest that interested users use and develop MoonShine together.
    </x-p>

    <x-sub-title>Where to start?</x-sub-title>
    <x-p>
        MoonShine is ready to appear in your project. Simply execute
        <x-link link="{{ route('moonshine.page', 'installation') }}">installation guide</x-link>,
        and then find in the documentation how to implement the required functionality and add it to your project.
    </x-p>

    <x-p>
        If you want to learn MoonShine quickly, I recommend checking out my
        <x-link link="https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy">video guides</x-link>
        and <x-link link="https://cutcode.dev/articles/moonshine-tips-tricks">articles</x-link>.
    </x-p>

    <x-p>
        Need help with MoonShine? You can ask a question at
        <x-link link="https://t.me/laravel_chat/24568">telegram-chat</x-link> or
        <x-link link="https://forms.gle/U41uLZzXBCibmwbE7">book a consultation</x-link>.
    </x-p>

    <x-image theme="light" src="{{ asset('screenshots/main.png') }}"></x-image>
    <x-image theme="dark" src="{{ asset('screenshots/main_dark.png') }}"></x-image>
</x-page>
