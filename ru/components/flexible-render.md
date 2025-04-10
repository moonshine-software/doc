# FlexibleRender

Компонент `FlexibleRender` позволяет быстро отрендерить простой текст, html или Blade views.

```php
make(
    Closure|Renderable|string $content,
    Closure|array $additionalData = []
)
```

```php
use MoonShine\UI\Components\FlexibleRender;

FlexibleRender::make('HTML'),

FlexibleRender::make(
    view('path_to_blade')
),

FlexibleRender::make(
    view('path_to_blade', ['data' => 'something'])
),

FlexibleRender::make(
    view('path_to_blade'),
    ['data' => 'something']
),
FlexibleRender::make(
    view('path_to_blade', ['var1' => 'something 1']),
    ['var2' => 'something 2']
),

FlexibleRender::make(
    fn($data) => view('path_to_blade', $data),
    fn() => ['data' => 'something']
),
```
