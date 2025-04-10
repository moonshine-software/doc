# Поля

Поля в **MoonShine**, в большинстве случаев, относятся к полям таблицы из базы данных.
В рамках `CRUD` они будут выводиться на главной странице раздела (ресурса) со списком и на странице создания и редактирования записей.

В **MoonShine** существует множество видов полей, которые покрывают все возможные требования!
Также они охватывают и все возможные связи в **Laravel** и для удобства называются так же, как и методы отношений
`BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany`, `HasOneThrough`, `HasManyThrough`, `MorphOne`, `MorphMany`.

Добавлять поля в `ModelResource` очень просто!
Для этого можно воспользоваться методами которые позволяют объявить поля для соответствующих страниц: `indexFields()`, `formFields()` или `detailFields()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostResource extends ModelResource
{
    // ...

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Title'),
                Text::make('Subtitle'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Title', 'title'),
            Text::make('Subtitle'),
        ];
    }
}
```
