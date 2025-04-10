# Dropdown

- [Основы](#basics)
- [Заголовок](#heading)
- [Подвал](#footer)
- [Расположение](#location)

---

<a name="basics"></a>
## Основы

Используя компонент `Dropdown`, вы можете создавать выпадающие блоки.

```php
make(
    ?string $title = null,
    Closure|string $toggler = '',
    Closure|Renderable|string $content = '',
    Closure|array $items = [],
    bool $searchable = false,
    Closure|string $searchPlaceholder = '',
    string $placement = 'bottom-start',
    Closure|string $footer = '',
)
```

- `$title` - заголовок для списка внутри `Dropdown`,
- `$toggler` - внешний вид кнопки для отображения,
- `$content` - контент Dropdown,
- `$items` - элементы, для формирования списка вида ul li,
- `$searchable` - поиск по контенту,
- `$searchPlaceholder` - placeholder для поиска,
- `$placement` - расположение,
- `$footer` - footer для списка внутри `Dropdown`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Dropdown;

Dropdown::make(
    'Dropdown',
    'Toggler',
    'Content',
    ['Item 1', 'Item 1']
)
```
tab: Blade
```blade
<x-moonshine::dropdown>
    <div class="m-4">
        Content
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```
~~~

<a name="heading"></a>
## Заголовок

```blade
<x-moonshine::dropdown title="Dropdown title">
    <div class="m-4">
        Content
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

<a name="footer"></a>
## Подвал

```blade
<x-moonshine::dropdown>
    <div class="m-4">
        Content
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
    <x-slot:footer>Dropdown footer</x-slot:footer>
</x-moonshine::dropdown>
```

<a name="location"></a>
## Расположение

```blade
<x-moonshine::dropdown placement="left">
    <div class="m-4">
        Content
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

Актуальный список доступных расположений смотрите в документации [popper.js](https://popper.js.org/docs/v2/constructors/#options).
