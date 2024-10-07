# Декоратор Collapse

  - [Создание](#make)
  - [Иконка](#icon)
  - [Отображение](#show)
  - [Сохранение состояния](#persist)

---

<a name="make"></a> 
## Создание

Декоратор *Collapse* позволяет сворачивать содержимое блока, сохраняя его состояние.

```php
make(Closure|string|array $labelOrFields = '', array $fields = [])
```

```php
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Заголовок/Слаг', [
            Text::make('Заголовок'),
            Text::make('Слаг')
        ])
    ];
}

//...
```

<a name="icon"></a> 
## Иконка

Метод `icon()` позволяет добавить иконку.

```php
use MoonShine\Decorations\Collapse;

//...

public function components(): array
{
    return [
        Collapse::make('Collapse')
            ->icon('heroicons.outline.users')
    ];
}

//...
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="show"></a> 
## Отображение

По умолчанию декоратор *Collapse* отображается в свернутом виде. Метод `show()` позволяет переопределить это поведение.

```php
show(bool $show = true)
```

```php
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Заголовок/Слаг', [
            Text::make('Заголовок'),
            Text::make('Слаг')
        ])
            ->show()
    ];
}

//...
```

<a name="persist"></a> 
## Сохранение состояния

По умолчанию *Collapse* запоминает состояние, но бывают случаи, когда этого делать не стоит. Метод `persist()` позволяет переопределить это поведение.

```php
persist(Closure|bool|null $condition = null)
```

```php
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;
 
//...
 
public function components(): array
{
return [
    Collapse::make('Заголовок/Слаг', [
        Text::make('Заголовок'),
        Text::make('Слаг')
    ])
        ->persist(fn () => false) 
    ];
}
 
//…
```
