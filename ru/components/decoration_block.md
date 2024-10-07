# Декоративный блок

- [Создание](#make)
- [Без заголовка](#wihtout-heading)
- [Иконка](#icon)

---

<a name="make"></a>
## Создание

Декоратор *Block* позволяет создавать стилизованные блоки.

Вы можете создать *Block*, используя статический метод `make()`.

```php
make(Closure|string|array $labelOrFields = '', array $fields = [])
```

```php
use MoonShine\Decorations\Block;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Block::make('Заголовок блока', [
            Text::make('Имя', 'first_name')
        ])
    ];
}

//...
```

<a name="no-title"></a>
## Без заголовка

Если блоку не нужен заголовок, то в метод `make()` нужно передать только массив.

```php
use MoonShine\Decorations\Block;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Block::make([
            Text::make('Имя', 'first_name')
        ])
    ];
}

//...
```

<a name="icon"></a>
## Иконка

Метод `icon()` позволяет добавить иконку.

```php
use MoonShine\Decorations\Block;

//...

public function components(): array
{
    return [
        Block::make('Блок')
            ->icon('heroicons.outline.users')
    ];
}

//...
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

