# Таблица

  - [Свойства](#properties)
  - [Кнопки](#buttons)
  - [Атрибуты](#attributes)
  - [Действия при клике](#click)
  - [Фиксированный заголовок таблицы](#sticky-table)
  - [Простая пагинация](#simple-pagination)
  - [Отключение пагинации](#disable-pagination)
  - [Асинхронный режим](#async)
  - [Обновление строки](#update-row)
  - [Отображение столбцов](#column-display)
  - [Модификация](#modify)

---

<a name="properties"></a>
## Свойства

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $sortColumn = ''; // Поле сортировки по умолчанию

    protected string $sortDirection = 'DESC'; // Тип сортировки по умолчанию

    protected int $itemsPerPage = 25; // Количество элементов на странице

    //...
}
```


<a name="buttons"></a>
## Кнопки

Для добавления кнопок в таблицу используйте `ActionButton` и методы `indexButtons` или `buttons` в ресурсе

> [!TIP]
> [Подробнее об ActionButton](https://moonshine-laravel.com/docs/resource/actionbutton/action_button)

```php
public function indexButtons(): array
{
   return [
       ActionButton::make('Link', '/endpoint'),
   ];
}
```

> [!TIP]
> Пример создания пользовательских кнопок для индексной таблицы в разделе [Рецепты](https://moonshine-laravel.com/docs/resource/recipes/recipes#custom-buttons)

Для массовых действий нужно добавить метод `bulk`

```php
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')->bulk(),
    ];
}
```

Вы также можете использовать метод `buttons`, но в этом случае кнопки будут на всех остальных страницах ресурса

```php
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
```

<a name="attributes"></a>
## Атрибуты

Через ресурсы моделей есть возможность настроить `tr` и `td` таблицы данных.
Для этого необходимо использовать соответствующие методы `trAttributes()` и `tdAttributes()`, которым нужно передать замыкание, возвращающее атрибуты для компонента таблицы.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Closure;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function trAttributes(): Closure
    {
        return function (
            Model $item,
            int $row,
            ComponentAttributeBag $attr
        ): ComponentAttributeBag {
            if ($item->id === 1 | $row === 2) {
                $attr->setAttributes([
                    'class' => 'bgc-green'
                ]);
            }

            return $attr;
        };
    }

    public function tdAttributes(): Closure
    {
        return function (
            Model $item,
            int $row,
            int $cell,
            ComponentAttributeBag $attr = null
        ): ComponentAttributeBag {
            if ($cell === 6) {
                $attr->setAttributes([
                    'class' => 'bgc-red'
                ]);
            }

            return $attr;
        };
    }

    //...
}
```

![img](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/table_class_dark.png)

<a name="click"></a>
## Действия при клике

По умолчанию при клике на tr ничего не произойдет, но вы можете изменить поведение на переход к редактированию, выбор или переход к детальному просмотру

```php
// Свойство ресурса
    // ClickAction::SELECT, ClickAction::DETAIL, ClickAction::EDIT

    protected ?ClickAction $clickAction = ClickAction::SELECT;
```

<a name="sticky-table"></a>
## Фиксированный заголовок таблицы

Свойство `stickyTable` ресурса модели позволяет зафиксировать заголовок при прокрутке таблицы с большим количеством элементов.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $stickyTable = true;

    // ...
}
```

<a name="simple-pagination"></a>
## Простая пагинация

Если вы не планируете отображать общее количество страниц, используйте `Simple Pagination`. Это позволит избежать дополнительных запросов для подсчета общего количества записей в базе данных.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $simplePaginate = true;

    // ...
}
```

![img](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/resource_simple_paginate_dark.png)

<a name="disable-pagination"></a>
## Отключение пагинации

Если вы не планируете использовать пагинацию, вы можете ее отключить.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $usePagination = false;

    // ...
}
```

<a name="async"></a>
## Асинхронный режим

Переключение режима без перезагрузки для фильтрации, сортировки и пагинации.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true;

    // ...
}
```

<a name="update-row"></a>
## Обновление строки

Вы можете обновить строку таблицы асинхронно; для этого необходимо вызвать событие:

```php
table-row-updated-{{componentName}}-{{row-key}}
```
-`{{componentName}}` - имя компонента;
-`{{row-key}}` - ключ строки.

Для добавления события можно использовать вспомогательный класс:

```php
AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'main-table-{row-id}')
```

-`{row-id}` - шорткод для id текущей записи модели.

> [!WARNING] 
> Наличие поля ID и асинхронного режима обязательно.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\ID;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Support\AlpineJs;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true;

    //...

    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
            Textarea::make('Body'),
            Switcher::make('Active')
                ->updateOnPreview(
                    events: [AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'index-table-{row-id}')]
                )
        ];
    }

    //...
}
```

Также доступен метод `withUpdateRow()`, который помогает упростить назначение события:

```php
TableBuilder::make()
    ->fields([
        ID::make()->sortable(),
        Text::make('Title'),
        Textarea::make('Body'),
        Switcher::make('Active')
            ->withUpdateRow('main-table')
    ])
    ->items($this->fetch())
    ->name('main-table')
    ->async(),
```

<a name="column-display"></a>
## Отображение столбцов

Вы можете позволить пользователям решать, какие столбцы отображать в таблице, сохраняя выбор. Для этого необходимо установить параметр ресурса `$columnSelection`.

```
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true;

    //...
}
```

Если нужно исключить поля из выбора, используйте метод `columnSelection()`.

```php
public function columnSelection(bool $active = true)
```

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true;

    //...

    public function fields(): array
    {
        return [
            ID::make()
                ->columnSelection(false),
            Text::make('Title'),
            Textarea::make('Body'),
        ];
    }

    //...
}
```

<a name="modify"></a>
## Модификация

Вы можете заменить `thead` или `tbody` или `tfoot`, а также добавить элементы в таблицу в `tbody` до и после первой строки.

#### thead()

```php
namespace App\MoonShine\Resources;

use MoonShine\Fields\Fields;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function thead(): ?Closure
    {
        return static fn(Fields $headFields): string => '<tr><th>Title</th></tr>';
    }
}
```

#### tbody()

```php
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbody(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>Content</td></tr>';
    }
}
```

#### tfoot()

```php
namespace App\MoonShine\Resources;

use MoonShine\ActionButtons\ActionButtons;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tfoot(): ?Closure
    {
        return static fn(ActionButtons $bulkButtons): string => '<tr><td>Footer</td></tr>';
    }
}
```

#### tbodyBefore()

```php
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbodyBefore(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>Before</td></tr>';
    }
}
```

#### tbodyAfter()

```php
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbodyAfter(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>After</td></tr>';
    }
}
```

