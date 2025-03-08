# FAQ

## Как использовать отношения в MoonShine?

**Eloquent** отношения в **MoonShine** реализуются через соответствующие одноименные поля.

**MoonShine** поддерживает все возможные отношения: `BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany` и другие.

Рассмотрим использование полей отношений на примере `BelongsTo`. Например, у вас есть модели `Post` и `Author`, где каждый пост принадлежит одному автору.

```php
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// В модели Post
public function author(): BelongsTo
{
    return $this->belongsTo(Author::class);
}
```

```php
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

// В MoonShine PostResource
public function formFields(): array
{
    return [
        // ...
        BelongsTo::make('Author', 'author', AuthorResource::class),
    ];
}
```

Подробнее о каждом типе связи читайте в разделах соответствующих полей в документации.

## Как работать с JSON полями?

Смотрите раздел поля [Json](/docs/{{version}}/fields/json).

##  Как добавить стили или классы к полям или компонентам?

[Добавление класса](/docs/{{version}}/components/attributes#class).

[Добавление стиля](/docs/{{version}}/components/attributes#style).

## Как использовать реактивность полей?

Общая информация о [реактивности полей](/docs/{{version}}/fields/basic-methods#reactive).

Вариант применение реактивности на примере поля [Slug](/docs/{{version}}/fields/slug#live).

## Как настроить права доступа для разных ролей пользователей?

На тему авторизации читайте соответствующий [раздел документации](/docs/{{version}}/model-resource/authorization).

Для интеграции управления доступом на основе ролей в **MoonShine**,
вы можете использовать сторонний пакет [moonshine-roles-permissions](https://getmoonshine.app/plugins/moonshine-roles-permissions).

## Как правильно использовать события ресурса (beforeCreating, afterCreated и т.п.)?

Смотрите [ModelResource > События](/docs/{{version}}/model-resource/events).

## Как настроить фильтрацию в ресурсе?

Смотрите [ModelResource > Фильтры](/docs/{{version}}/model-resource/filters).

## Как реализовать сортировку записей перетаскиванием?

Компонент **TableBuilder** имеет метод [reorderable()](/docs/{{version}}/components/table-builder#drag-and-drop-sorting),
который добавляет возможность сортировки строк перетаскиванием.

## Как кастомизировать внешний вид админ-панели?

Есть много способов изменить внешний вид шаблонов в **MoonShine**. Читайте разделы “Внешний вид” в документации.

## Как сохранить ID авторизованного пользователя при создании записи?

В следующем примере по умолчанию автором назначается текущий аутентифицированный пользователь.

```php
public function formFields(): array
{
    return [
        // ...
        BelongsTo::make('Author', resource: UserResource::class)
            ->default( request()->user() ),
    ];
}
```

Также можно добавить скрытое поле и заполнить его значением ID пользователя из реквеста.

```php
Hidden::make('Author')
    ->fill( auth()->id() )
```

Так же в разделе [ModelResource > События](/docs/{{version}}/model-resource/events) показан пример добавления поля в реквест через события.

## Как правильно работать с дробными числами в поле Number?

Достаточно указать нужных шаг с помощью метода `step()`, например "0.01".

## Как настроить асинхронный поиск в Select полях?

Смотрите раздел [Select](/docs/{{version}}/fields/select#async).

## Как изменить или скрыть элементы меню в зависимости от прав пользователя?

Смотрите [рецепт](/docs/{{version}}/recipes/menu-authorization).

## Как изменить формат даты в полях Date?

Смотрите раздел поля [Date](/docs/{{version}}/fields/date#format).

## Как изменить логотип и фавикон в админ-панели?

Логотип можно изменить в [конфигурации](/docs/{{version}}/configuration#logo).

Фавикон можно заменить в `Layout` в компоненте [Favicon](/docs/{{version}}/components/favicon#assets).

## Как реализовать множественную загрузку файлов?

Смотрите раздел поля [File](/docs/{{version}}/fields/file#multiple).

## Как настроить импорт/экспорт данных в CSV или Excel?

Смотрите раздел [Импорт / Экспорт](/docs/{{version}}/model-resource/import-export).

## Как работать с Markdown полями в MoonShine?

Вы можете воспользоваться пакетом [moonshine-software/easymde](https://github.com/moonshine-software/easymde).

## Как кастомизировать хлебные крошки в MoonShine?

Хлебные крошки можно переопределять на отдельных [страницах](/docs/{{version}}/page/index#breadcrumbs).

[Рецепт](/docs/{{version}}/recipes/custom-breadcrumbs), как изменять хлебные крошки из ресурса для отдельных страниц.

## Как убрать массовые действия и чекбоксы с индексной страницы?

[ModelResource > Основы](/docs/{{version}}/model-resource/index#active-actions).
