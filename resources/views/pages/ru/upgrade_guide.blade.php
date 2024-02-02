<x-page
    title="Upgrade Guide"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#requirements', 'label' => '1. Минимальные требования'],
            ['url' => '#composer', 'label' => '2. Composer.json'],
            ['url' => '#provider', 'label' => '3. MoonShineServiceProvider'],
            ['url' => '#icons', 'label' => '4. Icons'],
            ['url' => '#resources', 'label' => '5. Resources'],
            ['url' => '#fields', 'label' => '6. Fields'],
            ['url' => '#filters', 'label' => '7. Filters'],
            ['url' => '#import_export', 'label' => '8. Import/Export'],
            ['url' => '#actions', 'label' => '9. Actions'],
            ['url' => '#update', 'label' => '10. Обновление зависимостей'],
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

<x-sub-title id="requirements" hashtag="1">Минимальные требования</x-sub-title>

<x-ul :items="['php >=8.1', 'laravel >= 10.23']"></x-ul>

<x-moonshine::alert class="mt-8" type="info" icon="heroicons.information-circle">
    Перед обновлением рекомендуется удалить папку <code>public/vendor/moonshine</code>.
</x-moonshine::alert>

<x-sub-title id="composer" hashtag="2">Composer.json</x-sub-title>

<x-p>
    Изменить версию <strong>MoonShine</strong>.
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
    Выполнить консольную команду.
</x-p>

<x-code language="shell">
composer update
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    В процессе обновления возникнут ошибки. Это связано с тем что некоторые компоненты админ-панели были изменены.
    Следующие шаги помогут устранить эти ошибки.
</x-moonshine::alert>

<x-sub-title id="provider" hashtag="3">MoonShineServiceProvider</x-sub-title>

<x-p>
    Необходимо изменить <code>MoonShineServiceProvider</code>. Он теперь наследуется от MoonShineApplicationServiceProvider,
    а объявление меню вынесено в отдельный метод <code>menu()</code>.
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
    В <strong>MoonShine 2.0</strong> используются только иконки из набора Heroicons,
    поэтому необходимо произвести замену старых системных иконок (add, app, bookmark,
    bookmark, clip, delete, edit, export, filter, search, show и users).
</x-p>

@include('pages.ru.shared.alert_icons')

<x-sub-title id="resources" hashtag="5">Resources</x-sub-title>

<x-p>
    В <strong>MoonShine 2.0</strong> ресурсы изолированны от моделей,
    но есть специальный <em>ModelResource</em> для работы с Eloquent.
</x-p>

<x-p>
    <em>Resource</em> необходимо заменить на <em>ModelResource</em>, публичные свойства на защищенные.
</x-p>

<x-p>
    Свойство для отображения в полях отношений <code>titleField</code> необходимо переименовать в <code>column</code>.
</x-p>

<x-p>
    Свойство для перехода после сохранения <code>routeAfterSave</code> в <strong>MoonShine 2.0</strong> переименовано на
    <code>redirectAfterSave</code>, либо можно воспользоваться методом <code>redirectAfterSave()</code>,
    который возвращает строку с маршрутом для перенаправления.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('resources-index') . '#redirects' }}">Resources</x-link>.
</x-moonshine::alert>

<x-p>
    Так же были переименованы некоторые свойства.
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
    Изменения в <strong>MoonShine 2.0</strong> затронули и поля.
</x-p>

<x-p>
    У всех полей отношений изменился <em>namespace</em>.
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
    У полей отношений обязательно необходимо указать ресурс модели.<br />
    Второй параметр - не поле в таблице, а наименование отношения!
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
    В <strong>MoonShine 2.0</strong> для полей <em>HasOne</em> и <em>HasMany</em> больше нет разделения и
    отображаются только в resourceMode режиме. Методы <code>removable()</code> и <code>fullPage()</code> были исключены.<br />
    Если данные поля необходимо расположить в основной форме,
    то можно воспользоваться полем
    <x-link link="{{ to_page('fields-json') . '#relation' }}"><em>Json</em> в режиме отношения</x-link>.
</x-p>

<x-p>
    Метод <code>onlyCount()</code> поля <em>HasMany</em> переименован в <code>onlyLink()</code>
    и теперь позволяет отобразить не только количество, но и создает ссылку для их просмотра записей.
</x-p>

<x-p>
    У поля отношения <em>BelongsToMany</em> метод <code>select()</code> переименован в <code>selectMode()</code>.
</x-p>

<x-ul>
    <li>
        <code>SwitchBoolean</code> переименован в <code>Switcher</code>
    </li>
    <li>
        <code>SlideField</code> переименован в <code>RangeSlider</code>
    </li>
</x-ul>

<x-sub-title id="filters" hashtag="7">Filters</x-sub-title>

<x-p>
    В админ-панели <strong>MoonShine 2.0</strong> для построения фильтров используются так же поля,
    дублирующие поля для фильтров были исключены.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('resources-filters') }}">Filters</x-link>.
</x-moonshine::alert>

<x-sub-title id="import_export" hashtag="8">Import / Export</x-sub-title>

<x-p>
    По умолчанию импорт и экспорт уже включен во все ресурсы модели.
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
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('resources-import_export') }}">Import/Export</x-link>.
</x-moonshine::alert>

<x-sub-title id="actions" hashtag="9">Actions</x-sub-title>

<x-p>
    <code>ItemActions</code>, <code>FormActions</code> и <code>DetailActions</code> и
    соответствующие методы были исключены из админ-панели.<br />
    В <strong>MoonShine 2.0</strong> эту функцию выполняет <code>ActionButton</code>.
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
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('action_button') }}">ActionButton</x-link>.
</x-moonshine::alert>

<x-sub-title id="update" hashtag="10">Обновление зависимостей</x-sub-title>

<x-p>
    После внесения всех изменений, необходимо попытаться еще раз выполнить обновление зависимостей.
    Обновление должно завершиться без ошибок.
</x-p>

<x-code language="shell">
composer update
</x-code>

<x-p>
    Если во время обновления ассеты не были опубликованы, то их необходимо опубликовать.
</x-p>

<x-code language="shell">
    php artisan moonshine:publish
</x-code>

<x-p>или</x-p>

<x-code language="shell">
php artisan vendor:publish --tag=laravel-assets --ansi --force
</x-code>

<x-sub-title id="config" hashtag="11">Config</x-sub-title>

<x-p>
    В новой версии <strong>MoonShine</strong> полностью изменился сonfig.
    Опубликовать новый конфигурационный файл можно через консольную команду.
    После публикации, внесите необходимые корректировки.
</x-p>

<x-code language="shell">
php artisan moonshine:install
</x-code>

<x-sub-title id="dashboard" hashtag="12">Dashboard</x-sub-title>

<x-p>
    <em>Dashboard</em> как и <em>CustomPage</em> теперь это
    <x-link link="{{ to_page('page-class') }}">Pages</x-link>.
    После установки, для <em>Dashboard</em> генерируется страница <code>app/MoonShine/Pages/Dashboard.php</code>.
    Необходимо перенести все компоненты в новую страницу.
</x-p>

<x-moonshine::alert type="success" icon="heroicons.check-badge" class="mt-8">
    Поздравляем вас с успешным обновлением проекта!
</x-moonshine::alert>

</x-page>
