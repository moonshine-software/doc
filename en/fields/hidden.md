# Hidden

Extends [Text](/docs/{{version}}/fields/text) \* has the same features

The _Hidden_ field will be set by default to `type="hidden"`.  
The field will be hidden when building forms, but displayed in preview, and its wrapper will also be hidden.

```php
use MoonShine\Fields\Hidden;

//...

public function fields(): array
{
    return [
        Hidden::make('category_id')
    ];
}

//...
```