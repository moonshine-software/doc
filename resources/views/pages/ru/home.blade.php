<x-page title="MoonShine">

    <div style="max-width: 1440px">
        <video load="lazy" class="how-it-works-preview-video" autoplay muted preload="auto" playsinline>
            <source src="/video/moon_shine_logo_2.mp4" type="video/mp4" />
        </video>
    </div>

    <x-sub-title>Привет, пользователь Laravel!</x-sub-title>

    <x-p>
        <strong>MoonShine</strong> — это open source пакет для проектов на Laravel с открытым исходным кодом (лицензия MIT)
        для ускоренной разработки web-проектов.
    </x-p>
    <x-p>
        MoonShine отлично подходит для создания админ-панели, MVP, backoffice-приложений, и систем управления контентом (CMS).
    </x-p>
    <x-p>
        MoonShine это админ-панель, которую могут использовать разработчики разного уровня подготовки.
    </x-p>
    <x-p>
        <strong>Новички</strong> - без проблем реализуют распространенные задачи - авторизацию и CRUD.
        У MoonShine низкий порог вхождения, он дружелюбен для новичков.
    </x-p>

    <x-moonshine::alert type="warning" icon="heroicons.information-circle">
        MoonShine очень удобный и функциональный инструмент.
        Однако, для его использования необходимо уверенно знать основы Laravel.
        Поэтому, если вы новичок, я рекомендую пройти мой курс  <x-link link="https://cutcode.dev/l/k7mk">'Laravel Start'</x-link>,
        который поможет уверенно войти в мир Laravel и использовать MoonShine без затруднений.
    </x-moonshine::alert>

    <x-p>
        <strong>Профессионалы</strong> - без ограничений используют все возможности Laravel,
        при этом получая инструменты для ускорения работы - "framework on framework".
    </x-p>

    <x-p>
        Для предложения улучшений MoonShine или документации, обязательно создавайте
        <x-link link="https://github.com/moonshine-software/moonshine/issues/new/choose">Issue на GitHub</x-link> с подробным описанием идеи.
        Вы очень поможете проекту.
    </x-p>

    <x-sub-title>Особенности</x-sub-title>
    <x-p>
        <ul>
            <li>Использование MoonShine в проектах напоминает конструктор, помогая создавать необходимый функционал намного быстрее.</li>
            <li>Нет привязки к моделям, данные можно брать какие угодно</li>
            <li>Конструктор форм и таблиц</li>
            <li>Легковесный и простой в использовании AlpineJs</li>
            <li>TailwindCSS и Blade, привычно для подавляющего большинства Laravel разработчиков</li>
            <li>Возможность использовать Blade и Livewire-компоненты</li>
            <li>Удобный конструктор шаблона, изменение цветов и в целом дизайна</li>
        </ul>
    </x-p>

    <x-sub-title>История названия</x-sub-title>
    <x-p>
        Что означает MoonShine? Это не совсем "лунный свет": моя задумка - это название "самогон".
        Дословно это самостоятельное изготовление напитка в нелегальных условиях под покровом ночи.
        Так и я ночами в свободное время (в основном по ночам) разрабатывал эту админ-панель,
        делая качественный продукт с душой, для собственного употребления. Ну и для друзей.
        Уже всё готово для применения в Ваших проектах, создана документация с описанием порядка установки,
        настройки и возможностей. Предлагаю заинтересованным пользователям использовать и развивать MoonShine вместе.
    </x-p>

    <x-sub-title>С чего начать?</x-sub-title>
    <x-p>
        MoonShine готов появиться в вашем проекте. Просто выполните
        <x-link link="{{ route('moonshine.page', 'installation') }}">руководство по установке</x-link>,
        а дальше найдите в документации как реализовать нужный функционал и добавьте в свой проект.
    </x-p>

    <x-p>
        Если хотите быстро освоить MoonShine, рекомендую посмотреть мои
        <x-link link="https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy">видео гайды</x-link>
        и <x-link link="https://cutcode.dev/articles/moonshine-tips-tricks">статьи</x-link>.
    </x-p>

    <x-p>
        Понадобилась помощь по MoonShine? Можете задать вопрос в
        <x-link link="https://t.me/laravel_chat/24568">telegram-чате</x-link> или
        <x-link link="https://forms.gle/U41uLZzXBCibmwbE7">заказать консультацию</x-link>.
    </x-p>

    <x-image theme="light" src="{{ asset('screenshots/main.png') }}"></x-image>
    <x-image theme="dark" src="{{ asset('screenshots/main_dark.png') }}"></x-image>
</x-page>
