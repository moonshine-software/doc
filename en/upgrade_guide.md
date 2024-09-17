https://moonshine-laravel.com/docs/resource/getting-started/upgrade_guide?change-moonshine-locale=en

------

# Upgrade guide

![!Video upgrade guide]()

- [1. Minimum requirements](#minimum-requirements) 
- [2. Composer.json](#composerjson) 
- [3. MoonShineServiceProvider](#moonshineserviceprovider) 
- [4. Icons](#icons) 
- [5. Resources](#resources) 
- [6. Fields](#fields) 
- [7. Filters](#filters) 
- [8. Import / Export](#import-export) 
- [9. Actions](#actions) 
- [10. Updating dependencies](#updating-dependencies) 
- [11. Config](#config) 
- [12. Dashboard](#dashboard)

<a name="minimum-requirements"></a>
## 1. Minimum requirements

* php >=8.1
* laravel >= 10.23

> [!TIP]
> Before updating, it is recommended to delete the folder `public/vendor/moonshine`.

<a name="composerjson"></a>
## 2. Composer.json

Change version **MoonShine**.

```
    "require": {
        "php": "^8.1",
        "guzzlehttp/guzzle": "^7.2",
        "laravel/framework": "^10.23",
        "lee-to/moonshine-algolia-search": "^1.0",
        "moonshine/moonshine": "^2.0"
    },
}
```

Execute the console command.
```
composer update
```

> [!WARNING]
> Errors will occur during the upgrade process. This is because some components of the admin panel have been changed. The following steps will help to eliminate these errors.

<a name="moonshineserviceprovider"></a>
## 3. MoonShineServiceProvider

The `MoonShineServiceProvider` needs to be modified. It now inherits from MoonShineApplicationServiceProvider, and the menu declaration is moved to a separate method `menu()`.

```php
use Illuminate\Support\ServiceProvider;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
//...

class MoonShineServiceProvider extends ServiceProvider
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{

    public function boot(): void
    protected function menu(): array
    {
        app(MoonShine::class)->menu([
        return [
            MenuGroup::make('System', [
                MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical'),
                MenuItem::make('Admins', new MoonShineUserResource(), 'heroicons.outline.users'),
                MenuItem::make('Roles', new MoonShineUserRoleResource(), 'heroicons.outline.shield-exclamation'),
            ], 'heroicons.outline.user-group')->canSee(static function () {
                return auth('moonshine')->user()->moonshine_user_role_id === 1;
            }),

            //...

        ]);
        ];
    }
}
```

<a name="icons"></a>
## 4. Icons

**MoonShine 2.0** uses only icons from the Heroicons set, so it is necessary to replace the old system icons (add, app, bookmark, bookmark, clip, delete, edit, export, filter, search, show and users).

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="resources"></a>
## 5. Resources

In **MoonShine 2.0**, resources are isolated from models, but there is a special _ModelResource_ to work with Eloquent.

*Resource* should be replaced with *ModelResource*, public properties with protected properties.

The property to display in relationship fields `titleField` should be renamed to `column`. 

The property to go after save `routeAfterSave` in the **MoonShine 2.0** renamed to `redirectAfterSave`, or you can use the method `redirectAfterSave()`, which returns a string with the route to redirect.

> [!NOTE]
> For more information, please refer to the section [Resources](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#redirects).

Also some properties have been renamed.

```php
use MoonShine\Resources\Resource;
use MoonShine\Resources\ModelResource;

//...

class ArticleResource extends Resource
class ArticleResource extends ModelResource
{
    public static string $model = Article::class;
    protected string $model = Article::class;

    public static string $title = 'Articles';
    protected string $title = 'Articles';

    public string $titleField = 'title';
    protected string $column = 'title';

    protected string $routeAfterSave = 'index';

    public static string $orderField = 'created_at';
    protected string $sortColumn = 'created_at';

    public static string $orderType = 'DESC';
    protected string $sortDirection = 'DESC';

    public static array $with = ['author', 'comments'];
    protected array $with = ['author', 'comments'];

    //...

}
```

<a name="fields"></a>
## 6. Fields

The changes in **MoonShine 2.0** affect fields as well.

All relationship fields have had their _namespace_ changed.

```php
use MoonShine\Fields\BelongsTo; 
use MoonShine\Fields\Relationships\BelongsTo; 
 
use MoonShine\Fields\BelongsToMany; 
use MoonShine\Fields\Relationships\BelongsToMany; 
 
use MoonShine\Fields\HasMany; 
use MoonShine\Fields\Relationships\HasMany; 
 
use MoonShine\Fields\HasManyThrough; 
use MoonShine\Fields\Relationships\HasManyThrough; 
 
use MoonShine\Fields\HasOne; 
use MoonShine\Fields\Relationships\HasOne; 
 
use MoonShine\Fields\HasOneThrough; 
use MoonShine\Fields\Relationships\HasOneThrough; 
 
use MoonShine\Fields\MorphMany; 
use MoonShine\Fields\Relationships\MorphMany; 
 
use MoonShine\Fields\MorphTo; 
use MoonShine\Fields\Relationships\MorphTo; 
 
use MoonShine\Fields\MorphToMany; 
use MoonShine\Fields\Relationships\MorphToMany; 
```

> [!WARNING]
> For relationship fields it is obligatory to specify the model resource. The second parameter is not a field in the table, but the name of the relationship!

```php
use MoonShine\Fields\Relationships\BelongsTo;
 
class ArticleResource extends ModelResource
{
    //...
 
    public function fields(): array
    {
        BelongsTo::make('Author', resource: 'name') 
        BelongsTo::make('Author', 'author', resource: new MoonShineUserResource()); 
 
        //...
    }
 
    //...
}
```

In **MoonShine 2.0** for fields. *HasOne* and *HasMany* there is no more separation and are only displayed in resourceMode. Methods `removable()` and `fullPage()` have been excluded.
If these fields should be placed in the main form, you can use the field [Json in relationship mode](https://moonshine-laravel.com/docs/resource/fields/fields-json#relation).

Method `onlyCount()` fields *HasMany* renamed to `onlyLink()` and now allows you to display not only the quantity, but also creates a link to view their records.

The *BelongsToMany* relationship field has a *BelongsToMany* method `select()` renamed to `selectMode()`.

- `SwitchBoolean` renamed to `Switcher`
- `SlideField` renamed to `RangeSlider`

<a name="filters"></a>
## 7. Filters

In the **MoonShine 2.0** admin panel the same fields are used for building filters, duplicate fields for filters have been eliminated.

> [!NOTE]
> For more information, please refer to the section [Filters](https://moonshine-laravel.com/docs/resource/models-resources/resources-filters).

<a name="import-export"></a>
## 8. Import / Export

By default, imports and exports are already included in all model resources.

```php
use MoonShine\Actions\ExportAction;
use MoonShine\Actions\ImportAction;
//...

class ArticleResource extends ModelResource
{
    //...

    public function actions(): array
    {
        return [
            ExportAction::make('Export'),
            ImportAction::make('Import')
        ];
    }
}
```

> [!NOTE]
> For more information, please refer to the section [Import/Export](https://moonshine-laravel.com/docs/resource/models-resources/resources-import_export).

<a name="actions"></a>
## 9. Actions

`ItemActions`, `FormActions` and `DetailActions` and the corresponding methods were excluded from the admin panel. In **MoonShine 2.0**, this function is performed by.`ActionButton`.

```php
use MoonShine\FormActions\FormAction; 
use MoonShine\ItemActions\ItemAction; 
 
class ArticleResource extends ModelResource
{
    //...
 
   public function itemActions(): array 
   public function indexButtons(): array 
    {
        return [
            ItemAction::make('Go to', fn (Article $item) => to_route('articles.show', $item)) 
            ActionButton::make('Go to', fn (Article $item) => to_route('articles.show', $item)) 
        ];
    }
}
```

> [!TIP]
> For more information, please refer to the section [ActionButton](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).


<a name="updating-dependencies"></a>
## 10. Updating dependencies

After all changes have been made, you should try again to update the dependencies. The update should complete without errors.

```php
composer update
```

If the assets were not published at the time of the update, they must be published.

```php
php artisan moonshine:publish
```

or

```php
php artisan vendor:publish --tag=laravel-assets --ansi --force
```

<a name="config"></a>
## 11. Config

The config has been completely changed in new version of **MoonShine**. You can publish the new configuration file via the console command. After publishing, make the necessary adjustments.

```php
php artisan moonshine:install
```

<a name="dashboard"></a>
## 12. Dashboard

*Dashboard* as well as *CustomPage* are now [Pages](https://moonshine-laravel.com/docs/resource/page/page-class). Once installed, a page is generated for the *Dashboard* `app/MoonShine/Pages/Dashboard.php`. You need to move all components to a new page.

> [!TIP]
> Congratulations on your successful project update!
