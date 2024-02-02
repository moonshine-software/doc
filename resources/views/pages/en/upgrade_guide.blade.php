<x-page
    title="Upgrade Guide"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#requirements', 'label' => '1. Minimum requirements'],
            ['url' => '#composer', 'label' => '2. Composer.json'],
            ['url' => '#provider', 'label' => '3. MoonShineServiceProvider'],
            ['url' => '#icons', 'label' => '4. Icons'],
            ['url' => '#resources', 'label' => '5. Resources'],
            ['url' => '#fields', 'label' => '6. Fields'],
            ['url' => '#filters', 'label' => '7. Filters'],
            ['url' => '#import_export', 'label' => '8. Import/Export'],
            ['url' => '#actions', 'label' => '9. Actions'],
            ['url' => '#update', 'label' => '10. Updating dependencies'],
            ['url' => '#config', 'label' => '11. Config'],
            ['url' => '#ddashboard', 'label' => '12. Dashboard'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/y4RB25jb31c', 'title' => 'Video upgrade guide'],
    ]"
>

<x-moonshine::badge color="green">
    Upgrading To 2.0 From 1.5
</x-moonshine::badge>

<x-sub-title id="requirements" hashtag="1">Minimum requirements</x-sub-title>

<x-ul :items="['php >=8.1', 'laravel >= 10.23']"></x-ul>

<x-moonshine::alert class="mt-8" type="info" icon="heroicons.information-circle">
    Before updating, it is recommended to delete the folder <code>public/vendor/moonshine</code>.
</x-moonshine::alert>

<x-sub-title id="composer" hashtag="2">Composer.json</x-sub-title>

<x-p>
    Change version <strong>MoonShine</strong>.
</x-p>

<x-code language="json">
"require": {
    "php": "^8.1",
    "guzzlehttp/guzzle": "^7.2",
    "laravel/framework": "^10.23",
    "lee-to/moonshine-algolia-search": "^1.0",
    "moonshine/moonshine": "^1.60" // [tl! -- **]
    "moonshine/moonshine": "^2.0" // [tl! ++ **]
},
</x-code>

<x-p>
    Execute the console command.
</x-p>

<x-code language="shell">
composer update
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Errors will occur during the upgrade process. This is because some components of the admin panel have been changed.
    The following steps will help to eliminate these errors.
</x-moonshine::alert>

<x-sub-title id="provider" hashtag="3">MoonShineServiceProvider</x-sub-title>

<x-p>
    The <code>MoonShineServiceProvider</code> needs to be modified. It now inherits from MoonShineApplicationServiceProvider,
    and the menu declaration is moved to a separate method <code>menu()</code>.
</x-p>

<x-code language="php">
use Illuminate\Support\ServiceProvider; // [tl! -- **]
use MoonShine\Providers\MoonShineApplicationServiceProvider; // [tl! ++ **]
//...

class MoonShineServiceProvider extends ServiceProvider // [tl! -- **]
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider // [tl! ++ **]
{

    public function boot(): void // [tl! -- **]
    protected function menu(): array // [tl! ++ **]
    {
        app(MoonShine::class)->menu([ // [tl! -- **]
        return [ // [tl! ++ **]
            MenuGroup::make('System', [
                MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical'),
                MenuItem::make('Admins', new MoonShineUserResource(), 'heroicons.outline.users'),
                MenuItem::make('Roles', new MoonShineUserRoleResource(), 'heroicons.outline.shield-exclamation'),
            ], 'heroicons.outline.user-group')->canSee(static function () {
                return auth('moonshine')->user()->moonshine_user_role_id === 1;
            }),

            //...

        ]); // [tl! -- **]
        ]; // [tl! ++ **]
    }
}
</x-code>

<x-sub-title id="icons" hashtag="4">Icons</x-sub-title>

<x-p>
    <strong>MoonShine 2.0</strong> uses only icons from the Heroicons set,
    so it is necessary to replace the old system icons (add, app, bookmark,
    bookmark, clip, delete, edit, export, filter, search, show and users).
</x-p>

@include('pages.en.shared.alert_icons')

<x-sub-title id="resources" hashtag="5">Resources</x-sub-title>

<x-p>
    In <strong>MoonShine 2.0</strong>, resources are isolated from models,
    but there is a special <em>ModelResource</em> to work with Eloquent.
</x-p>

<x-p>
    <em>Resource</em> should be replaced with <em>ModelResource</em>, public properties with protected properties.
</x-p>

<x-p>
    The property to display in relationship fields <code>titleField</code> should be renamed to <code>column</code>.
</x-p>

<x-p>
    The property to go after save <code>routeAfterSave</code> in the <strong>MoonShine 2.0</strong> renamed to
    <code>redirectAfterSave</code>, or you can use the method <code>redirectAfterSave()</code>,
    which returns a string with the route to redirect.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more information, please refer to the section
    <x-link link="{{ to_page('resources-index') . '#redirects' }}">Resources</x-link>.
</x-moonshine::alert>

<x-p>
    Also some properties have been renamed.
</x-p>

<x-code language="php">
use MoonShine\Resources\Resource; // [tl! -- **]
use MoonShine\Resources\ModelResource; // [tl! ++ **]

//...

class ArticleResource extends Resource // [tl! -- **]
class ArticleResource extends ModelResource // [tl! ++ **]
{
    public static string $model = Article::class; // [tl! -- **]
    protected string $model = Article::class; // [tl! ++ **]

    public static string $title = 'Articles'; // [tl! -- **]
    protected string $title = 'Articles'; // [tl! ++ **]

    public string $titleField = 'title'; // [tl! -- **]
    protected string $column = 'title'; // [tl! ++ **]

    protected string $routeAfterSave = 'index'; // [tl! -- **]

    public static string $orderField = 'created_at'; // [tl! -- **]
    protected string $sortColumn = 'created_at'; // [tl! ++ **]

    public static string $orderType = 'DESC'; // [tl! -- **]
    protected string $sortDirection = 'DESC'; // [tl! ++ **]

    public static array $with = ['author', 'comments']; // [tl! -- **]
    protected array $with = ['author', 'comments']; // [tl! ++ **]

    //...

}
</x-code>

<x-sub-title id="fields" hashtag="6">Fields</x-sub-title>

<x-p>
    The changes in <strong>MoonShine 2.0</strong> affect fields as well.
</x-p>

<x-p>
    All relationship fields have had their <em>namespace</em> changed.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo; // [tl! -- **]
use MoonShine\Fields\Relationships\BelongsTo; // [tl! ++ **]

use MoonShine\Fields\BelongsToMany; // [tl! -- **]
use MoonShine\Fields\Relationships\BelongsToMany; // [tl! ++ **]

use MoonShine\Fields\HasMany; // [tl! -- **]
use MoonShine\Fields\Relationships\HasMany; // [tl! ++ **]

use MoonShine\Fields\HasManyThrough; // [tl! -- **]
use MoonShine\Fields\Relationships\HasManyThrough; // [tl! ++ **]

use MoonShine\Fields\HasOne; // [tl! -- **]
use MoonShine\Fields\Relationships\HasOne; // [tl! ++ **]

use MoonShine\Fields\HasOneThrough; // [tl! -- **]
use MoonShine\Fields\Relationships\HasOneThrough; // [tl! ++ **]

use MoonShine\Fields\MorphMany; // [tl! -- **]
use MoonShine\Fields\Relationships\MorphMany; // [tl! ++ **]

use MoonShine\Fields\MorphTo; // [tl! -- **]
use MoonShine\Fields\Relationships\MorphTo; // [tl! ++ **]

use MoonShine\Fields\MorphToMany; // [tl! -- **]
use MoonShine\Fields\Relationships\MorphToMany; // [tl! ++ **]
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    For relationship fields it is obligatory to specify the model resource.<br />
    The second parameter is not a field in the table, but the name of the relationship!
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;

class ArticleResource extends ModelResource
{
    //...

    public function fields(): array
    {
        BelongsTo::make('Author', resource: 'name') // [tl! -- **]
        BelongsTo::make('Author', 'author', resource: new MoonShineUserResource()); // [tl! ++ **]

        //...
    }

    //...
}
</x-code>

<x-p>
    In <strong>MoonShine 2.0</strong> for fields. <em>HasOne</em> and <em>HasMany</em> there is no more separation and
    are only displayed in resourceMode. Methods <code>removable()</code> and <code>fullPage()</code> have been excluded.<br />
    If these fields should be placed in the main form,
    you can use the field
    <x-link link="{{ to_page('fields-json') . '#relation' }}"><em>Json</em> in relationship mode</x-link>.
</x-p>

<x-p>
    Method <code>onlyCount()</code> fields <em>HasMany</em> renamed to <code>onlyLink()</code>
    and now allows you to display not only the quantity, but also creates a link to view their records.
</x-p>

<x-p>
    The <em>BelongsToMany</em> relationship field has a <em>BelongsToMany</em> method <code>select()</code> renamed to <code>selectMode()</code>.
</x-p>

<x-ul>
    <li>
        <code>SwitchBoolean</code> renamed to <code>Switcher</code>
    </li>
    <li>
        <code>SlideField</code> renamed to <code>RangeSlider</code>
    </li>
</x-ul>

<x-sub-title id="filters" hashtag="7">Filters</x-sub-title>

<x-p>
    In the <strong>MoonShine 2.0</strong> admin panel the same fields are used for building filters,
    duplicate fields for filters have been eliminated.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more information, please refer to the section
    <x-link link="{{ to_page('resources-filters') }}">Filters</x-link>.
</x-moonshine::alert>

<x-sub-title id="import_export" hashtag="8">Import / Export</x-sub-title>

<x-p>
    By default, imports and exports are already included in all model resources.
</x-p>

<x-code language="php">
use MoonShine\Actions\ExportAction; // [tl! -- **]
use MoonShine\Actions\ImportAction; // [tl! -- **]

class ArticleResource extends ModelResource
{
    //...

    public function actions(): array // [tl! -- **]
    { // [tl! -- **]
        return [ // [tl! -- **]
            ExportAction::make('Export'), // [tl! -- **]
            ImportAction::make('Import') // [tl! -- **]
        ]; // [tl! -- **]
    } // [tl! -- **]
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more information, please refer to the section
    <x-link link="{{ to_page('resources-import_export') }}">Import/Export</x-link>.
</x-moonshine::alert>

<x-sub-title id="actions" hashtag="9">Actions</x-sub-title>

<x-p>
    <code>ItemActions</code>, <code>FormActions</code> and <code>DetailActions</code> and
    the corresponding methods were excluded from the admin panel.<br />
    In <strong>MoonShine 2.0</strong>, this function is performed by. <code>ActionButton</code>.
</x-p>


<x-code language="php">
use MoonShine\FormActions\FormAction; // [tl! -- **]
use MoonShine\ItemActions\ItemAction; // [tl! -- **]

class ArticleResource extends ModelResource
{
    //...

   public function itemActions(): array // [tl! -- **]
   public function indexButtons(): array // [tl! ++ **]
    {
        return [
            ItemAction::make('Go to', fn (Article $item) => to_route('articles.show', $item)) // [tl! -- **]
            ActionButton::make('Go to', fn (Article $item) => to_route('articles.show', $item)) // [tl! ++ **]
        ];
    }
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more information, please refer to the section
    <x-link link="{{ to_page('action_button') }}">ActionButton</x-link>.
</x-moonshine::alert>

<x-sub-title id="update" hashtag="10">Updating dependencies</x-sub-title>

<x-p>
    After all changes have been made, you should try again to update the dependencies.
    The update should complete without errors.
</x-p>

<x-code language="shell">
composer update
</x-code>

<x-p>
    If the assets were not published at the time of the update, they must be published.
</x-p>

<x-code language="shell">
    php artisan moonshine:publish
</x-code>

<x-p>or</x-p>

<x-code language="shell">
php artisan vendor:publish --tag=laravel-assets --ansi --force
</x-code>

<x-sub-title id="config" hashtag="11">Config</x-sub-title>

<x-p>
    The config has been completely changed in new version of <strong>MoonShine</strong>.
    You can publish the new configuration file via the console command.
    After publishing, make the necessary adjustments.
</x-p>

<x-code language="shell">
php artisan moonshine:install
</x-code>

<x-sub-title id="dashboard" hashtag="12">Dashboard</x-sub-title>

<x-p>
    <em>Dashboard</em> as well as <em>CustomPage</em> are now
    <x-link link="{{ to_page('page-class') }}">Pages</x-link>.
    Once installed, a page is generated for the <em>Dashboard</em> <code>app/MoonShine/Pages/Dashboard.php</code>.
    You need to move all components to a new page.
</x-p>

<x-moonshine::alert type="success" icon="heroicons.check-badge" class="mt-8">
    Congratulations on your successful project update!
</x-moonshine::alert>

</x-page>
