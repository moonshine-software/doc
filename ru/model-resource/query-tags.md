# Быстрые фильтры (теги)

- [Основы](#basics)
- [Иконка](#icon)
- [Активный элемент](#active-item)
- [Условие отображения](#display-condition)
- [Псевдоним](#alias)
- [Выпадающий список](#dropdown)
- [События](#events)
- [Модификатор кнопки](#modify-button)

---

<a name="basics"></a>
## Основы

Иногда возникает необходимость создать фильтры (выборку результатов) и отобразить их на листинге.
Для таких ситуаций были созданы теги.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                'Post with author', // Заголовок тега
                fn(Builder $query) => $query->whereNotNull('author_id') // Query builder
            )
        ];
    }
}

```

![query_tags](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/query_tags.png#light)
![query_tags_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/query_tags_dark.png#dark)

<a name="icon"></a>
## Иконка

Вы можете добавить иконку к тегу с помощью метода `icon()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;

QueryTag::make(
    'Post without an author',
    fn(Builder $query) => $query->whereNull('author_id')
)
    ->icon('users')
```

> [!NOTE]
> Для более подробной информации, пожалуйста, обратитесь к разделу [Иконки](/docs/{{version}}/appearance/icons).

<a name="active-item"></a>
## Активный элемент

Вы можете сделать `QueryTag` активным по умолчанию. Для этого нужно использовать метод `default()`.

```php
default(Closure|bool|null $condition = null)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;

QueryTag::make(
    'All posts',
    fn(Builder $query) => $query
)
    ->default()
```

<a name="display-condition"></a>
## Условие отображения

Вы можете захотеть отображать теги только при определенных условиях.
Для этого можно использовать метод `canSee()`, которому нужно передать функцию обратного вызова, возвращающую `TRUE` или `FALSE`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;

QueryTag::make(
    'Post with author', // Заголовок тега
    fn(Builder $query) => $query->whereNotNull('author_id')
)
    ->canSee(fn() => auth()->user()->moonshine_user_role_id === 1)
```

<a name="alias"></a>
## Псевдоним

По умолчанию значение для URL генерируется автоматически из параметра `label`.
При этом все символы не латинского алфавита заменяются соответствующей транслитерацией `'Заголовок' => 'zagolovok'`.

Метод `alias()` позволяет задать собственное значение для URL.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;

QueryTag::make(
    'Archived Posts',
    fn(Builder $query) => $query->where('is_archived', true)
)
    ->alias('archive')
```

<a name="dropdown"></a>
## Выпадающий список

По умолчанию все кнопки-теги выводятся в строку, но вы можете вывести их через выпадающий список.
Для этого в ресурсе измените свойство `$queryTagsInDropdown`.

```php
class PostResource extends ModelResource
{
    protected bool $queryTagsInDropdown = true;

    // ...
}
```

<a name="events"></a>
## События

Вызов собственных событий после успешного обновления данных:

```php
QueryTag::make('QueryTag', fn($q) => $q)->events([
    AlpineJs::event(
        JsEvent::FRAGMENT_UPDATED, 'custom-fragment'
    )
])
```

<a name="modify-button"></a>
## Модификатор кнопки

```php
QueryTag::make('QueryTag', fn($q) => $q)
    ->modifyButton(fn(ActionButton $btn) => $btn)
```
