# Декораторы Layout

- [Flex](#flex)
- [Grid/Column](#grid-column)

---

Иногда для удобства восприятия необходимо разделить форму на несколько блоков. По умолчанию они расположены один под другим, но с помощью декораторов `Layout` вы можете легко изменить порядок отображения.

<a name="flex"></a>  
## Flex

Декорация *Flex* придает элементам соответствующее позиционирование.

```php
use MoonShine\Decorations\Flex;

//...

public function components(): array
{
    return [
        Flex::make([
            Text::make('Заголовок'),
            Text::make('Слаг'),
        ])
    ];
}

//...
```

#### Дополнительные опции

```php
use MoonShine\Decorations\Flex;

//...

public function components(): array
{
    return [
        Flex::make([
            Text::make('Заголовок'),
            Text::make('Слаг'),
        ])
            ->withoutSpace() // Убрать отступы
            ->justifyAlign('start') // На основе tailwind классов justify-[param]
            ->itemsAlign('start') // На основе tailwind классов items-[param]
    ];
}

//...
```

<a name="grid-column"></a>  
## Grid/Column

Декораторы *Grid* и *Column* позволяют организовать сетку с колонками.

Метод `columnSpan()` позволяет установить ширину блока в *Grid*.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

`$columnSpan` - актуально для десктопной версии,
`$adaptiveColumnSpan` - актуально для мобильной версии.

```php
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;

//...
public function components(): array
{
    return [
        Grid::make([
            Column::make([
                // ...
            ])
                ->columnSpan(6),

            Column::make([
                // ...
            ])
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]
> Админ-панель **MoonShine** использует 12-колоночную сетку.

