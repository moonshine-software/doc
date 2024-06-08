<x-page
    title="Commands"
    :sectionMenu="[
        'Sections' => [
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

@include('pages.en.shared.alert_select_item_console')

<x-sub-title id="install">Install</x-sub-title>

<x-p>
    Command to install the <strong>MoonShine</strong> package in your <em>Laravel</em> project:
</x-p>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-p>
    Available options:
</x-p>

<x-ul>
    <li><code>-u</code>, <code>--without-user</code> - without creating a super user;</li>
    <li><code>-m</code>, <code>--without-migrations</code> - without performing migrations.</li>
</x-ul>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('installation') }}">Installation</x-link>.
</x-moonshine::alert>

<x-sub-title id="apply">Apply</x-sub-title>

<x-p>
    The command to create the apply class is:
</x-p>

<x-code language="shell">
    php artisan moonshine:apply
</x-code>

<x-p>
    After executing the command, a file will be created in the <code>app/MoonShine/Applies</code> directory.
    The created class must be registered with the service provider.
</x-p>

<x-sub-title id="component">Component</x-sub-title>

<x-p>
    The command creates a custom component:
</x-p>

<x-code language="shell">
    php artisan moonshine:component
</x-code>

<x-p>
    After executing the command, a class for the component will be created in the <code>app/MoonShine/Components</code> directory
    and <em>Blade</em> file in the <code>resources/views/admin/components</code> directory.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('components-index') }}">Components</x-link>.
</x-moonshine::alert>

<x-sub-title id="controller">Controller</x-sub-title>

<x-p>
    Command to create a controller:
</x-p>

<x-code language="shell">
    php artisan moonshine:controller
</x-code>

<x-p>
    After executing the command, a controller class will be created in the <code>app/MoonShine/Controllers</code> directory.
    Which can be used in admin panel routes.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('advanced-controller') }}">Controllers</x-link>.
</x-moonshine::alert>

<x-sub-title id="field">Field</x-sub-title>

<x-p>
    The command allows you to create a custom field:
</x-p>

<x-code language="shell">
    php artisan moonshine:field
</x-code>

<x-p>
    When executing the command, you can specify whether the field will extend the base class or another field.
</x-p>

<x-p>
    After executing the command, a field class will be created in the <code>app/MoonShine/Fields</code> directory
    and <em>Blade</em> file in the directory <code>/resources/views/admin/fields</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('fields-index') }}">Fields</x-link>.
</x-moonshine::alert>

<x-sub-title id="handler">Handler</x-sub-title>

<x-p>
    The command creates a <em>Handler</em> class for its import and export implementations:
</x-p>

<x-code language="shell">
    php artisan moonshine:handler
</x-code>

<x-p>
    After executing the command, the handler class will be created in the directory <code>app/MoonShine/Handlers</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('resources-import_export') }}">Import/Export</x-link>.
</x-moonshine::alert>

<x-sub-title id="page">Page</x-sub-title>

<x-p>
    The command creates a page for the admin panel:
</x-p>

<x-code language="shell">
    php artisan moonshine:page
</x-code>

<x-p>
    Available options:
</x-p>

<x-ul>
    <li><code>--crud</code> - creates a group of pages: index, detail and form page;</li>
    <li>
        <code>--dir=</code> - the directory in which the files will be located relative to <code>app/MoonShine</code>,
        default <code>Page</code>;
    </li>
    <li>
        <code>--extends=</code> - a class that the page will extend, for example IndexPage, FormPage or DetailPage.
    </li>
</x-ul>

<x-p>
    After executing the command, a default page (or group of pages) will be created in the directory
    <code>app/MoonShine/Pages</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('page-class') }}">Page</x-link>.
</x-moonshine::alert>

<x-sub-title id="policy">Policy</x-sub-title>

<x-p>
    The command creates a <em>Policy</em> bound to the admin panel user:
</x-p>

<x-code language="shell">
    php artisan moonshine:policy
</x-code>

<x-p>
    After executing the command, a class will be created in the <code>app/Policies</code> directory.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('advanced-authorization') }}">Authorization</x-link>.
</x-moonshine::alert>

<x-sub-title id="resource">Resource</x-sub-title>

<x-p>
    Command to create resources:
</x-p>

<x-code language="shell">
    php artisan moonshine:resource
</x-code>

<x-p>
    Available options:
</x-p>

<x-ul>
    <li><code>--m|model=</code> - Eloquent model for model resource;</li>
    <li><code>--t|title=</code> - section title;</li>
    <li><code>--test</code> or <code>--pest</code> - additionally generate a test class.</li>
</x-ul>

<x-p>
    There are several options available when creating a <em>Resource</em>:
    <x-ul>
        <li>
            <x-link :link="to_page('resources-fields') . '#default'"><strong>Default model resource</strong></x-link>
            - model resource with common fields;
        </li>
        <li>
            <x-link :link="to_page('resources-fields') . '#separate'"><strong>Separate model resource</strong></x-link>
            - model resource with field separation;
        </li>
        <li>
            <x-link :link="to_page('resources-pages')"><strong>Model resource with pages</strong></x-link>
            - model resource with pages;
        </li>
        <li>
            <strong>Empty resource</strong>
            - empty resource.
        </li>
    </x-ul>
</x-p>

<x-p>
    After executing the command, a resource file will be created in the <code>app/MoonShine/Resources/</code> directory.<br/>
    If a model resource with pages is created, additional pages will be created in the directory
    <code>app/MoonShine/Pages</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('resources-index') }}">Models Resources</x-link>.
</x-moonshine::alert>

<x-sub-title id="type_cast">Type Cast</x-sub-title>

<x-p>
    The command creates a TypeCast class for working with data:
</x-p>

<x-code language="shell">
    php artisan moonshine:type-cast
</x-code>

<x-p>
    After executing the command, a file will be created in the <code>app/MoonShine/TypeCasts</code> directory.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('advanced-type_casts') }}">TypeCasts</x-link>.
</x-moonshine::alert>

<x-sub-title id="user">User</x-sub-title>

<x-p>
    The command that allows you to create a super user:
</x-p>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-p>
    Available options:
</x-p>

<x-ul>
    <li><code>--u|username=</code> - user login/email;</li>
    <li><code>--N|name=</code> - user name;</li>
    <li><code>--p|password=</code> - password.</li>
</x-ul>

<x-sub-title id="publish">Publish</x-sub-title>

<x-p>
    Command for publish:
</x-p>

<x-code language="shell">
    php artisan moonshine:publish
</x-code>

<x-p>
    There are several options available for publishing:
    <x-ul>
        <li><strong>Assets</strong> - <strong>MoonShine</strong> admin panel assets;</li>
        <li>
            <x-link link="{{ to_page('appearance-assets') }}#vite"><strong>Assets template</strong></x-link>
            - creates a template for adding your own styles to the <strong>MoonShine</strong> admin panel;
        </li>
        <li>
            <x-link :link="to_page('appearance-layout_builder')"><strong>Layout</strong></x-link>
            - MoonShineLayout class, responsible for the general appearance of the admin panel;
        </li>
        <li>
            <x-link link="{{ to_page('appearance-index') }}#favicons"><strong>Favicons</strong></x-link>
            - overrides the template for changing favicons;
        </li>
        <li>
            <strong>System Resources</strong> - system MoonShineUserResource, MoonShineUserRoleResource,
            which you can change.
        </li>
    </x-ul>
</x-p>

</x-page>
