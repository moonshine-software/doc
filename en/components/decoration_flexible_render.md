# Decoration FlexibleRender

---

## Make
The *FlexibleRender* decorator allows you to quickly render simple text, html or blade views.

You can create *FlexibleRender* using the static method `make()` class `FlexibleRender`.

```php
make(Closure|View|string $content, Closure|array $additionalData = [])
```

```php
use MoonShine\Components\FlexibleRender;

//...

public function components(): array
{
    return [
        FlexibleRender::make('HTML'),
        // or
        FlexibleRender::make(view('path_to_blade')),
        // or
        FlexibleRender::make(view('path_to_blade', ['data' => 'something'])),
        // or
        FlexibleRender::make(view('path_to_blade'), ['data' => 'something']),
        FlexibleRender::make(view('path_to_blade', ['var1' => 'something 1']), ['var2' => 'something 2']),
        //or
        FlexibleRender::make(fn($data) => view('path_to_blade', $data), fn() => ['data' => 'something']),
    ];
}

//...
```
