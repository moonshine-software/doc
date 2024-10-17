# Range

- [Создание](#make)
- [Атрибуты](#attributes)
- [Фильтр](#filter)

Расширяет [Number](/docs/{{version}}/fields/number) 
* имеет те же функции

<a name="make"></a>
## Создание

Поле _Range_ является расширением _Number_, позволяет устанавливать значения для двух логически связанных полей.

Поскольку диапазон имеет два значения, вам нужно указать их с помощью метода `fromTo()`.

```php
fromTo(string $fromField, string $toField)
```

```php
use MoonShine\Fields\Range;

//...

public function fields(): array
{
    return [
        Range::make('Age')
            ->fromTo('age_from', 'age_to')
    ];
}

//...
```

![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/range.png) ![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/range_dark.png)

<a name="attributes"></a>
## Атрибуты

Если вам нужно добавить пользовательские атрибуты для полей, вы можете использовать соответствующие методы `fromAttributes()` и `toAttributes()`.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

```php
use MoonShine\Fields\Range;

//...

public function fields(): array
{
    return [
        Range::make('Age')
            ->fromTo('age_from', 'age_to')
            ->fromAttributes(['placeholder'=> 'from'])
            ->toAttributes(['placeholder'=> 'to'])
    ];
}

//...
```

<a name="filter"></a>
## Фильтр

При использовании поля _Range_ для построения фильтра метод `fromTo()` не используется, поскольку фильтрация происходит по одному полю в таблице базы данных.

```php
use MoonShine\Fields\Range;

//...

public function filters(): array
{
    return [
        Range::make('Age',  'age')
    ];
}

//...
```
