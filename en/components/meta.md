# Meta

@include('_includes/note-about-appearance-layout')

The **Meta** component is designed to place metadata on html page.

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
> Parent component: [Html](/docs/{{version}}/components/html).
