# Руководство по обновлению

![!Видео руководство по обновлению](https://www.youtube.com/watch?v=y4RB25jb31c)

- [1. Минимальные требования](#minimum-requirements)
- [2. Composer.json](#composerjson)
- [3. MoonShineServiceProvider](#moonshineserviceprovider)
- [4. Иконки](#icons)
- [5. Ресурсы](#resources)
- [6. Поля](#fields)
- [7. Фильтры](#filters)
- [8. Импорт / Экспорт](#import-export)
- [9. Действия](#actions)
- [10. Обновление зависимостей](#updating-dependencies)
- [11. Конфигурация](#config)
- [12. Панель управления](#dashboard)

---

<a name="minimum-requirements"></a>
## 1. Минимальные требования

* php >=8.1,
* laravel >= 10.23.

> [!TIP]
> Перед обновлением рекомендуется удалить папку `public/vendor/moonshine`.

<a name="composerjson"></a>
## 2. Composer.json

Измените версию **MoonShine**.

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

Выполните консольную команду.
```
composer update
```

> [!WARNING]
> В процессе обновления будут возникать ошибки. Это связано с тем, что некоторые компоненты панели администрирования были изменены. Следующие шаги помогут устранить эти ошибки.

<a name="moonshineserviceprovider"></a>
## 3. MoonShineServiceProvider

Необходимо изменить `MoonShineServiceProvider`. Теперь он наследуется от MoonShineApplicationServiceProvider, а объявление меню перенесено в отдельный метод `menu()`.

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
## 4. Иконки

**MoonShine 2.0** использует только иконки из набора Heroicons, поэтому необходимо заменить старые системные иконки (add, app, bookmark, bookmark, clip, delete, edit, export, filter, search, show и users).

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="resources"></a>
## 5. Ресурсы

В **MoonShine 2.0** ресурсы изолированы от моделей, но есть специальный _ModelResource_ для работы с Eloquent.

*Resource* следует заменить на *ModelResource*, публичные свойства на защищенные свойства.

Свойство для отображения в полях отношений `titleField` следует переименовать в `column`.

Свойство для перехода после сохранения `routeAfterSave` в **MoonShine 2.0** переименовано в `redirectAfterSave`, или можно использовать метод `redirectAfterSave()`, который возвращает строку с маршрутом для перенаправления.

> [!NOTE]
> Для получения дополнительной информации обратитесь к разделу [Ресурсы](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#redirects).

Также были переименованы некоторые свойства.

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
## 6. Поля

Изменения в **MoonShine 2.0** затрагивают и поля.

У всех полей отношений изменен _namespace_.

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
> Для полей отношений обязательно указывать ресурс модели. Второй параметр - не поле в таблице, а название отношения!

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

В **MoonShine 2.0** для полей *HasOne* и *HasMany* больше нет разделения и отображаются только в resourceMode. Методы `removable()` и `fullPage()` были исключены.
Если эти поля должны быть размещены в основной форме, можно использовать поле [Json в режиме отношений](https://moonshine-laravel.com/docs/resource/fields/fields-json#relation).

Метод `onlyCount()` полей *HasMany* переименован в `onlyLink()` и теперь позволяет отображать не только количество, но и создает ссылку для просмотра их записей.

У поля отношений *BelongsToMany* метод `select()` переименован в `selectMode()`.

- `SwitchBoolean` переименован в `Switcher`,
- `SlideField` переименован в `RangeSlider`.

<a name="filters"></a>
## 7. Фильтры

В панели администрирования **MoonShine 2.0** для построения фильтров используются те же поля, дублирующие поля для фильтров устранены.

> [!NOTE]
> Для получения дополнительной информации обратитесь к разделу [Фильтры](https://moonshine-laravel.com/docs/resource/models-resources/resources-filters).

<a name="import-export"></a>
## 8. Импорт / Экспорт

По умолчанию импорт и экспорт уже включены во все ресурсы моделей.

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
> Для получения дополнительной информации обратитесь к разделу [Импорт/Экспорт](https://moonshine-laravel.com/docs/resource/models-resources/resources-import_export).

<a name="actions"></a>
## 9. Действия

`ItemActions`, `FormActions` и `DetailActions` и соответствующие методы были исключены из панели администрирования. В **MoonShine 2.0** эту функцию выполняет `ActionButton`.

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
> Для получения дополнительной информации обратитесь к разделу [ActionButton](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).


<a name="updating-dependencies"></a>
## 10. Обновление зависимостей

После внесения всех изменений следует попробовать снова обновить зависимости. Обновление должно завершиться без ошибок.

```php
composer update
```

Если в момент обновления не были опубликованы assets, их необходимо опубликовать.

```php
php artisan moonshine:publish
```

или

```php
php artisan vendor:publish --tag=laravel-assets --ansi --force
```

<a name="config"></a>
## 11. Конфигурация

В новой версии **MoonShine** полностью изменен config. Вы можете опубликовать новый файл конфигурации через консольную команду. После публикации внесите необходимые корректировки.

```php
php artisan moonshine:install
```

<a name="dashboard"></a>
## 12. Панель управления

*Dashboard*, как и *CustomPage*, теперь являются [Страницами](https://moonshine-laravel.com/docs/resource/page/page-class). После установки для *Dashboard* генерируется страница `app/MoonShine/Pages/Dashboard.php`. Необходимо перенести все компоненты на новую страницу.

> [!TIP]
> Поздравляем с успешным обновлением проекта!
