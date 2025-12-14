# Meta

@include('_includes/note-about-appearance-layout')

Компонент **Meta** предназначен для размещения метаданных на html-странице.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Meta;

Meta::make('csrf-token')
    ->customAttributes([
        'content' => 'token',
    ]),
Meta::make()
    ->customAttributes([
        'name' => 'description',
        'content' => 'Page description',
    ]),
```

> [!NOTE]
> Родительский компонент: [Html](/docs/{{version}}/components/html).
