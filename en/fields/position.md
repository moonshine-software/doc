# Position

Inherits from [Preview](/docs/{{version}}/fields/preview).

* has the same capabilities

The *Position* field allows you to create numbering for repeating elements.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Position::make(),
        Text::make('Title'),
        Text::make('Value'),
    ])
```
