# Flex

- [Основы](#basics)
- [Выравнивание](#alignment)
- [Перенос](#wrap)

---

<a name="basics"></a>
## Основы

Для расположения элементов на странице можно использовать компонент `Flex`.
Компоненты внутри `Flex` будут отображаться в режиме `display: flex`.

```php
make(
    iterable $components = [],
    int $colSpan = 12,
    int $adaptiveColSpan = 12,
    string $itemsAlign = 'center',
    string $justifyAlign = 'center',
    bool $withoutSpace = false
)
```

- `$components` - список компонентов,
- `$colSpan` - количество колонок, которые занимает блок для размеров экрана 1280px и более,
- `$adaptiveColSpan` - количество колонок, которые занимает блок для размеров экрана до 1280px,
- `$itemsAlign` - аналог css класса `items-$itemsAlign` в **Tailwind**,
- `$justifyAlign` - аналог css класса `justify-$justifyAlign` в **Tailwind**,
- `$withoutSpace` - флаг для отступов.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Flex;

Flex::make([
    Text::make('Test'),
    Text::make('Test 2'),
]),
```
tab: Blade
```blade
<x-moonshine::layout.flex :justifyAlign="'end'">
    <div>Text 1</div>
    <div>Text 2</div>
</x-moonshine::layout.flex>
```
~~~

<a name="alignment"></a>
## Выравнивание

Для выравнивания элементов вы можете использовать методы `itemsAlign()` и `justifyAlign()`.

```php
Flex::make([
    Text::make('Test'),
    Text::make('Test 2'),
])
    ->justifyAlign('between')
    ->itemsAlign('start')
```

<a name="wrap"></a>
## Перенос

Для переноса элементов (`flex-wrap`) вы можете использовать метод `wrap()`.

```php
Flex::make([
    Text::make('Test'),
    Text::make('Test 2'),
])
    ->wrap()
```
