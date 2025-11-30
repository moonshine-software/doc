---
video: https://youtu.be/bcFOkXuPSRk?si=wB5vPbEn8EUN8jJx&t=391
---

# Поля

[Поля](/docs/{{version}}/fields/index) в **MoonShine** используются не только для ввода данных, но и для их вывода.
В большинстве случаев, они относятся к полям таблицы из базы данных.

В **MoonShine** существует множество видов полей, которые покрывают все возможные требования!
Также они охватывают и все возможные связи в **Laravel** и для удобства называются так же, как и методы отношений
`BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany`, `HasOneThrough`, `HasManyThrough`, `MorphOne`, `MorphMany`.

Добавлять поля на страницы ресурса очень просто!
Для этого нужно на соответствующих страницах объявить поля в методе `fields()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title'),
        ];
    }
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Title')
                    ->required(),
                Text::make('Subtitle')
                    ->nullable(),
            ]),
        ];
    }
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
            Text::make('Subtitle'),
        ];
    }
}
```
