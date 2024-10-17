# Preview

- [Создание](#make)
- [Бейдж](#badge)
- [Булево значение](#boolean)
- [Ссылка](#link)
- [Изображение](#image)

> [!WARNING]
> Поле не предназначено для ввода/изменения данных!

<a name="make"></a>
## Создание

Используя поле *Preview*, вы можете отображать текстовые данные из любого поля модели или генерировать текст.

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Предпросмотр', 'preview', static fn() => fake()->realText())
    ];
}

//...
```

![preview](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/preview.png)
![preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/preview_dark.png)

<a name="badge"></a>
## Бейдж

Метод `badge()` позволяет отображать поле в виде значка, например, для отображения статуса заказа. Метод принимает параметр в виде строки или замыкания с цветом значка.

```php
badge(string|Closure|null $color = null)
```

Доступные цвета:

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-primary">primary</span>
    <span class="badge badge-secondary">secondary</span>
    <span class="badge badge-success">success</span>
    <span class="badge badge-warning">warning</span>
    <span class="badge badge-error">error</span>
    <span class="badge badge-info">info</span>
</p>

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-purple">purple</span>
    <span class="badge badge-pink">pink</span>
    <span class="badge badge-blue">blue</span>
    <span class="badge badge-green">green</span>
    <span class="badge badge-yellow">yellow</span>
    <span class="badge badge-red">red</span>
    <span class="badge badge-gray">gray</span>
</p>

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Статус')
            ->badge(fn($status, Field $field) => $status === 1 ? 'green' : 'gray')
    ];
}

//...
```

<a name="boolean"></a>
## Булево значение

Метод `boolean()` позволяет отображать поле в виде метки (зеленой или красной) для булевых значений.

```php
boolean(
    mixed $hideTrue = null,
    mixed $hideFalse = null
)
```

Параметры `hideTrue` и `hideFalse` позволяют скрыть метку для значений.

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Активно')
            ->boolean(hideTrue: false, hideFalse: false)
    ];
}

//...
```

<a name="link"></a>
## Ссылка

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
- `$blank` - открывать ссылку в новой вкладке.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Ссылка')
            ->link('https://moonshine-laravel.com', blank: false),
        Preview::make('Ссылка')
            ->link(fn($link, Field $field) => $link, fn($name, Field $field) => 'Перейти')
    ];
}

//...
```

![preview_all](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/preview_all.png)
![preview_all_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/preview_all_dark.png)

<a name="image"></a>
## Изображение

Метод `image()` позволяет преобразовать URL в миниатюру с изображением.

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Миниатюра')
            ->image()
    ];
}

//...
```

![preview_image](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/preview_image.png)
![preview_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/preview_image_dark.png)
