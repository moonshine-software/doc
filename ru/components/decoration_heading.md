# Декоратор Heading

- [Создание](#make)
- [Градация](#gradation)
- [Тег](#custom-tag)

---

<a name="make"></a>
## Создание

Декоратор *Heading* позволяет добавлять заголовки к контенту.

Вы можете создать *Heading*, используя статический метод `make()`, передав ему текст заголовка.

```php
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Heading::make('Заголовок/Слаг'),
        Text::make('Заголовок'),
        Text::make('Слаг'),
    ];
}

//...
```

<a name="gradation"></a>
## Градация

```php
h(int $gradation = 3, $asClass = true)
```

Метод позволяет обернуть содержимое в тег *h1 - h6*.
Первый параметр определяет градацию тега, второй определяет, использовать ли тег или класс.

```php
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        // Будут теги h1 - h4
        Heading::make('Панель управления')->h(1, false),
        Heading::make('MoonShine')->h(2, false),
        Heading::make('Демо версия')->h(asClass: false),
        Heading::make('Заголовок')->h(4, false),

        // Будут div.h1 - div.h4
        Heading::make('Панель управления')->h(1),
        Heading::make('MoonShine')->h(2),
        Heading::make('Демо версия')->h(), // h3
        Heading::make('Заголовок')->h(4),
    ];
}

//...
```

<a name="custom-tag"></a>
## Тег

```php
tag(string $tag)
```

Метод позволяет обернуть содержимое в указанный тег.

```php
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        // Будут p.h1 - p.h4
        Heading::make('Панель управления')->tag('p')->h(1),
        Heading::make('MoonShine')->tag('p')->h(2),
        Heading::make('Демо версия')->tag('p')->h(),
        Heading::make('Заголовок')->tag('p')->h(4),
    ];
}

//...
```
