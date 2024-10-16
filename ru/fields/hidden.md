# Hidden

Расширяет [Text](/docs/{{version}}/fields/text) * имеет те же функции

Поле _Hidden_ будет установлено по умолчанию как `type="hidden"`.  
Поле будет скрыто при построении форм, но отображено в предпросмотре, и его обертка также будет скрыта.

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
