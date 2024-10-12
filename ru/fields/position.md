# Position

Наследует [Preview](/docs/{{version}}/fields/preview).

\* имеет те же возможности

Поле *Position* позволяет создавать нумерацию для повторяющихся элементов.

```php
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Position::make(), 
        Text::make('Title'),
        Text::make('Value'),
        Switcher::make('Active')
    ])
```