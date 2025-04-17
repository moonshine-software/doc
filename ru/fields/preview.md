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

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

С помощью поля `Preview` вы можете отображать текстовые данные из любого поля в модели или генерировать любой контент.

> [!WARNING]
> Поле НЕ предназначено для ввода/изменения данных!

```php
use MoonShine\UI\Fields\Preview;

Preview::make(
    'Preview',
    'preview',
    static fn() => fake()->realText()
)
```

![preview](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview.png#light)
![preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_dark.png#dark)

<a name="view-methods"></a>
## Виды отображений

<a name="badge"></a>
### Бейдж

Метод `badge()` позволяет отображать поле в виде значка, например, для отображения статуса заказа.
Метод принимает параметр в виде строки или замыкания с цветом значка.

```php
badge(string|Closure|null $color = null)
```

Доступные цвета:

<p class="colors">
<span class="color color-primary">primary</span>
<span class="color color-secondary">secondary</span>
<span class="color color-success">success</span>
<span class="color color-warning">warning</span>
<span class="color color-error">error</span>
<span class="color color-info">info</span>
<span class="color color-purple">purple</span>
<span class="color color-pink">pink</span>
<span class="color color-blue">blue</span>
<span class="color color-green">green</span>
<span class="color color-yellow">yellow</span>
<span class="color color-red">red</span>
<span class="color color-gray">gray</span>
</p>

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

![preview_all](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_all.png#light)
![preview_all_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_all_dark.png#dark)

<a name="image"></a>
### Изображение

Метод `image()` позволяет преобразовать URL в миниатюру с изображением.

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Thumb')
    ->image()
```

![preview_image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_image.png#light)
![preview_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_image_dark.png#dark)
