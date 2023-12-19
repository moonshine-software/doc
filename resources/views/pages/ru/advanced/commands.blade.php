<x-page
    title="Commands"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#install ', 'label' => 'Install '],
            ['url' => '#apply', 'label' => 'Apply'],
            ['url' => '#component', 'label' => 'Component'],
            ['url' => '#controller', 'label' => 'Controller'],
            ['url' => '#field', 'label' => 'Field'],
            ['url' => '#handler', 'label' => 'Handler'],
            ['url' => '#page', 'label' => 'Page'],
            ['url' => '#policy', 'label' => 'Policy'],
            ['url' => '#resource', 'label' => 'Resource'],
            ['url' => '#type_cast', 'label' => 'Type cast'],
            ['url' => '#user', 'label' => 'User'],
            ['url' => '#publish', 'label' => 'Publish'],
        ]
    ]"
>

<x-sub-title id="install">Install</x-sub-title>

<x-p>
    Команда для установки пакета <strong>MoonShine</strong> в ваш проект на <em>Laravel</em>:
</x-p>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-p>
    Доступные опции:
</x-p>

<x-ul>
    <li><code>-u</code>, <code>--without-user</code> - без создания супер пользователя;</li>
    <li><code>-m</code>, <code>--without-migrations </code> - без выполнения миграций.</li>
</x-ul>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'installation') }}">Installation</x-link>.
</x-moonshine::alert>

<x-sub-title id="apply">Apply</x-sub-title>

<x-p>
    Команда для создания класса apply:
</x-p>

<x-code language="shell">
    php artisan moonshine:apply
</x-code>

<x-p>
    После выполнения команды будет создан файл в директории <code>app/MoonShine/Applies</code>.
    Созданный класс необходимо зарегистрировать в сервис провайдере.
</x-p>

<x-sub-title id="component">Component</x-sub-title>

<x-p>
    Команда создает кастомный компонент:
</x-p>

<x-code language="shell">
    php artisan moonshine:component
</x-code>

<x-p>
    После выполнения команды будет создан класс для компонента в директории <code>app/MoonShine/Components</code>
    и <em>Blade</em> файл в директории <code>resources/views/admin/components</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'components-index') }}">Components</x-link>.
</x-moonshine::alert>

<x-sub-title id="controller">Controller</x-sub-title>

<x-p>
    Команда для создания контроллера:
</x-p>

<x-code language="shell">
    php artisan moonshine:controller
</x-code>

<x-p>
    После выполнения команды будет создан класс контроллера в директории <code>app/MoonShine/Controllers</code>.
    Который можно использовать в маршрутах админ-панели.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'advanced-controller') }}">Controllers</x-link>.
</x-moonshine::alert>

<x-sub-title id="field">Field</x-sub-title>

<x-p>
    Команда позволяет создать кастомное поле:
</x-p>

<x-code language="shell">
    php artisan moonshine:field
</x-code>

<x-p>
    При выполнении команды можно указать будет ли поле расширять базовый класс или другое поле.
</x-p>

<x-p>
    После выполнения команды будет создан класс поля в директории <code>app/MoonShine/Fields</code>
    и <em>Blade</em> файл в директории <code>/resources/views/admin/fields</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'fields-index') }}">Fields</x-link>.
</x-moonshine::alert>

<x-sub-title id="handler">Handler</x-sub-title>

<x-p>
    Команда создает <em>Handler</em> класс для своих реализаций импорта и экспорта:
</x-p>

<x-code language="shell">
    php artisan moonshine:handler
</x-code>

<x-p>
    После выполнения команды будет создан класс handler в директории <code>app/MoonShine/Handlers</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'resources-import-export') }}">Import/Export</x-link>.
</x-moonshine::alert>

<x-sub-title id="page">Page</x-sub-title>

<x-p>
    Команда создает страницу для админ-панели:
</x-p>

<x-code language="shell">
    php artisan moonshine:page
</x-code>

<x-p>
    Доступные опции:
</x-p>

<x-ul>
    <li><code>--crud</code> - создает группу страниц: индексная, детальная и страница с формой;</li>
    <li>
        <code>--dir=</code> - директория в которой будут располагаться файлы относительно <code>app/MoonShine</code>,
        по умолчанию <code>Page</code>;
    </li>
    <li>
        <code>--extends=</code> - класс который будет расширять страница, например IndexPage, FormPage или DetailPage.
    </li>
</x-ul>

<x-p>
    После выполнения команды будет создана страница (или группа страниц) по умолчанию в директории
    <code>app/MoonShine/Pages</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'page-class') }}">Page</x-link>.
</x-moonshine::alert>

<x-sub-title id="policy">Policy</x-sub-title>

<x-p>
    Команда создает <em>Policy</em> с привязкой к пользователю админ-панели:
</x-p>

<x-code language="shell">
    php artisan moonshine:policy
</x-code>

<x-p>
    После выполнения команды будет создан класс в директории <code>app/Policies</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'advanced-authorization') }}">Authorization</x-link>.
</x-moonshine::alert>

<x-sub-title id="resource">Resource</x-sub-title>

<x-p>
    Команда для создания ресурсов:
</x-p>

<x-code language="shell">
    php artisan moonshine:resource
</x-code>

<x-p>
    Доступные опции:
</x-p>

<x-ul>
    <li><code>--m|model=</code> - Eloquent модель для ресурса модели;</li>
    <li>
        <code>--t|title=</code> - заголовок раздела.
    </li>
</x-ul>

<x-p>
    При создания <em>Resource</em> доступно несколько вариантов:
    <x-ul>
        <li>
            <x-link :link="route('moonshine.page', 'resources-fields') . '#default'"><strong>Default model resource</strong></x-link>
            - ресурс модели с общими полями;
        </li>
        <li>
            <x-link :link="route('moonshine.page', 'resources-fields') . '#separate'"><strong>Separate model resource</strong></x-link>
            - ресурс модели с разделением полей;
        </li>
        <li>
            <x-link :link="route('moonshine.page', 'resources-pages')"><strong>Model resource with pages</strong></x-link>
            - ресурс модели со страницами;
        </li>
        <li>
            <strong>Empty resource</strong>
            - пустой ресурс.
        </li>
    </x-ul>
</x-p>

<x-p>
    После выполнения команды, файл ресурса будет создан в директории <code>app/MoonShine/Resources/</code>.<br/>
    Если создается ресурс модели со страницами, дополнительно будут созданы страницы в директории
    <code>app/MoonShine/Pages</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'resources-index') }}">Models Resources</x-link>.
</x-moonshine::alert>

<x-sub-title id="type_cast">Type Cast</x-sub-title>

<x-p>
    Команда создает класс TypeCast для работы данными:
</x-p>

<x-code language="shell">
    php artisan moonshine:type-cast
</x-code>

<x-p>
    После выполнения команды будет создан файл в директории <code>app/MoonShine/TypeCasts</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'advanced-type_casts') }}">TypeCasts</x-link>.
</x-moonshine::alert>

<x-sub-title id="user">User</x-sub-title>

<x-p>
    Команда которая позволяет создать супер пользователя:
</x-p>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-p>
    Доступные опции:
</x-p>

<x-ul>
    <li><code>--u|username=</code> - login/email пользователя;</li>
    <li><code>--N|name=</code> - имя пользователя;</li>
    <li><code>--p|password=</code> - пароль.</li>
</x-ul>

<x-sub-title id="publish">Publish</x-sub-title>

<x-p>
    Команда для публикаций:
</x-p>

<x-code language="shell">
    php artisan moonshine:publish
</x-code>

<x-p>
    Для публикации доступно несколько вариантов:
    <x-ul>
        <li><strong>Assets</strong> - ассеты админ-панели <strong>MoonShine</strong>;</li>
        <li>
            <x-link :link="route('moonshine.page', 'appearance-layout_builder')"><strong>Layout</strong></x-link>
            - класс MoonShineLayout, отвечающий за общий вид админ-панели;
        </li>
        <li>
            <strong>System Resources</strong> - системные MoonShineUserResource, MoonShineUserRoleResource,
            которые вы сможете изменить.
        </li>
    </x-ul>
</x-p>

</x-page>
