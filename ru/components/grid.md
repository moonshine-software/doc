# Grid

- [Основы](#basics)
- [Колонки](#columns)
- [Пример](#example)

---

<a name="basics"></a>
## Основы

Для расположения элементов на странице можно использовать компонент `Grid`.

```php
make(
    iterable $components = [],
    int $gap = 6,
)
```

- `$components` - набор компонентов,
- `$gap` - отступ между компонентами.

<a name="columns"></a>
## Колонки

Чтобы расположить элементы внутри `Grid`, используется компонент `Column`.

```php
make(
    iterable $components = [],
    int $colSpan = 12,
    int $adaptiveColSpan = 12,
)
```

 - `$components` - набор компонентов,
 - `$colSpan` - количество колонок, которые занимает блок для размеров экрана 1280px и более,
 - `$adaptiveColSpan` - количество колонок, которые занимает блок для размеров экрана до 1280px.

> [!NOTE]
> Сетка состоит из 12 колонок.

<a name="example"></a>
## Пример

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\Text;

Grid::make([
    Column::make(
        [
            Text::make('Text')
        ],
        colSpan: 6,
        adaptiveColSpan: 6
    ),
    Column::make(
        [
            Text::make('Text')
        ],
        colSpan: 6,
        adaptiveColSpan: 6
    ),
])
```
tab: Blade
```blade
<x-moonshine::layout.grid>
    <x-moonshine::layout.column adaptiveColSpan="6" colSpan="6">
        {{ fake()->text() }}
    </x-moonshine::layout.column>
    <x-moonshine::layout.column adaptiveColSpan="6" colSpan="6">
        {{ fake()->text() }}
    </x-moonshine::layout.column>
</x-moonshine::layout.grid>
```
~~~
