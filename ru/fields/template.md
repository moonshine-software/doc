# Template

*Template* не имеет готовой реализации и позволяет конструировать поле с помощью *fluent interface* в процессе объявления.

```php
use MoonShine\UI\Fields\Template;
use MoonShine\UI\Fields\Text;

Template::make('MyField')
    ->setLabel('My Field')
    ->fields([
        Text::make('Title')
    ])
```