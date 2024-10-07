# Компонент Badge

- [Создание](#make)
- [Цвета](#colors)

---

<a name="make"></a>
## Создание

Компонент *Badge* позволяет создавать значки.

Вы можете создать *Badge*, используя статический метод `make()` класса `Badge`.

```php
make(string $value = '', string $color = 'purple')
```

- `$value` - текст значка,
- `$color` - цвет значка.

```php
use MoonShine\Components\Badge;

//...

public function components(): array
{
    return [
        Badge::make(
            'new',
            'green'
        )
    ];
}

//...
```

<a name="color"></a>
## Цвета

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
