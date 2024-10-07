# Компонент Tabs

- [Создание](#make)
- [Вертикальное отображение вкладок](#vertical-tab)
- [Активная вкладка](#active-tab)
- [Иконка](#tab-icon)
- [ID вкладки](#tab-id)

---

<a name="make"></a>
## Создание
Компонент *Tabs* позволяет создавать вкладки.

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                Text::make('Seo заголовок')

                //...
            ]),
            Tab::make('Категории', [
                //...
            ])
        ])
    ];
}

//...
```

<a name="vertical-tab"></a>
## Вертикальное отображение вкладок

Метод `vertical()` позволяет отображать вкладки в вертикальном режиме.

```php
vertical(Closure|bool|null $condition = null)
```

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Категории', [
                //...
            ])
        ])->vertical()
    ];
}
//...
```

По умолчанию минимальная ширина блока вкладок, при которой меняется отображение на встроенное, составляет `480px`. Вы можете изменить значение минимальной ширины через метод `customAttributes()`:

```php
Tabs::make([
        //...
    ])
    ->customAttributes([
        'data-tabs-vertical-min-width' => 600
    ])
```

<a name="active-tab"></a>
## Активная вкладка

Метод `active()` позволяет указать, какая вкладка должна быть активной по умолчанию.

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Категории', [
                //...
            ])
                ->active()
        ])
    ];
}

//...
```

<a name="tab-icon"></a>
## Иконка

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Категории', [
                //...
            ])
                ->icon('heroicons.outline.pencil')
        ])
    ];
}

//...
```

<a name="tab-id"></a>
## ID вкладки

Метод `uniqueId()` позволяет установить ID вкладки.
Таким образом вы можете реализовать собственную логику для вкладок с использованием **Alpine.js**.

```php
uniqueId(string $id)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Вкладка 1', [
                //...

                ActionButton::make('Перейти к вкладке 2')->onClick(fn() => 'setActiveTab(`my-tab-2`)', 'prevent'),
            ])
                ->uniqueId('my-tab-1'),

            Tab::make('Вкладка 2', [
                //...

                ActionButton::make('Перейти к вкладке 1')->onClick(fn() => 'setActiveTab(`my-tab-1`)', 'prevent'),
            ])
                ->uniqueId('my-tab-2')
        ])
    ];
}

//...
```
