# Preview

- [Основы](#basics)
- [Виды отображений](#view-methods)
  - [Бейдж](#badge)
  - [Метка](#boolean)
  - [Ссылка](#link)
  - [Изображение](#image)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](#/docs/{{version}}/fields/basic-methods.md).

С помощью поля *Preview* вы можете отображать текстовые данные из любого поля в модели или генерировать любой контент.

> [!WARNING]
> Поле не предназначено для ввода/изменения данных!

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Preview', 'preview', static fn() => fake()->realText())
```

![preview](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview.png)

![preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_dark.png)

<a name="view-methods"></a>
## Виды отображений

<a name="badge"></a>
### Бейдж

Метод `badge()` позволяет отображать поле в виде значка, например, для отображения статуса заказа. Метод принимает параметр в виде строки или замыкания с цветом значка.

```php
badge(string|Closure|null $color = null)
```

Доступные цвета:

<span style="background-color: #7843e9; padding: 5px; border-radius: 0.375rem">primary</span> <span style="background-color: #ec4176; padding: 5px; border-radius: 0.375rem">secondary</span> <span style="background-color: #00aa00; padding: 5px; border-radius: 0.375rem">success</span> <span style="background-color: #ffdc2a; padding: 5px; border-radius: 0.375rem; color: rgb(139 116 0 / 1);">warning</span> <span style="background-color: #e02d2d; padding: 5px; border-radius: 0.375rem">error</span> <span style="background-color: #0079ff; padding: 5px; border-radius: 0.375rem">info</span>

<span style="background-color: rgb(243 232 255 / 1); color: rgb(107 33 168 / 1); padding: 5px; border-radius: 0.375rem">purple</span>
<span style="background-color: rgb(252 231 243 / 1); color: rgb(157 23 77 / 1); padding: 5px; border-radius: 0.375rem">pink</span>
<span style="background-color: rgb(219 234 254 / 1); color: rgb(30 64 175 / 1); padding: 5px; border-radius: 0.375rem">blue</span>
<span style="background-color: rgb(220 252 231 / 1); color: rgb(22 101 52 / 1); padding: 5px; border-radius: 0.375rem">green</span>
<span style="background-color: rgb(254 249 195 / 1); color: rgb(133 77 14 / 1); padding: 5px; border-radius: 0.375rem">yellow</span>
<span style="background-color: rgb(243 232 255 / 1); color: rgb(153 27 27 / 1); padding: 5px; border-radius: 0.375rem">red</span>
<span style="background-color: rgb(243 244 246 / 1); color: rgb(31 41 55 / 1); padding: 5px; border-radius: 0.375rem">gray</span>

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Status')
    ->badge(fn($status, Field $field) => $status === 1 ? 'green' : 'gray')
```

<a name="boolean"></a>
### Метка

Метод `boolean()` позволяет отображать поле в виде метки (зеленой или красной) для булевых значений.

```php
boolean(
    mixed $hideTrue = null,
    mixed $hideFalse = null
)
```

Параметры `hideTrue` и `hideFalse` позволяют скрыть метку для значений.

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Active')
    ->boolean(hideTrue: false, hideFalse: false)
```

<a name="link"></a>
### Ссылка

Метод `link()` позволяет отображать поле в виде ссылки.

```php
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false,
)
```

- `$link` - URL ссылки,
- `$name` - текст ссылки,
- `$icon` - название иконки,
- `$withoutIcon` - не отображать иконку ссылки,
- `$blank` - открыть ссылку в новой вкладке.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](/docs/{{version}}/icons).

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Link')
    ->link('https://moonshine-laravel.com', blank: false),
Preview::make('Link')
    ->link(fn($link, Field $field) => $link, fn($name, Field $field) => 'Go')
```

![preview_all](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_all.png)
![preview_all_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_all_dark.png)

<a name="image"></a>
### Изображение

Метод `image()` позволяет преобразовать URL в миниатюру с изображением.

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Thumb')
    ->image()
```

![preview_image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_image.png)
![preview_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_image_dark.png)