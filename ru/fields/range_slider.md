# RangeSlider

- [Создание](#make)
- [Фильтр](#filter)

---

Расширяет [Range](/docs/{{version}}/fields/range) 
* имеет те же функции

<a name="make"></a>
## Создание

Поле _RangeSlider_ является расширением _Range_ и дополнительно имеет возможность изменения значений с помощью ползунка.

```php
use MoonShine\Fields\RangeSlider;

//...

public function fields(): array
{
    return [
        RangeSlider::make('Age')
            ->fromTo('age_from', 'age_to')
    ];
}

//...
```

![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/slide.png) ![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/slide_dark.png)

<a name="filter"></a>
## Фильтр

При использовании поля _RangeSlider_ для построения фильтра метод `fromTo()` не используется, поскольку фильтрация происходит по одному полю в таблице базы данных.

```php
use MoonShine\Fields\RangeSlider;

//...

public function filters(): array
{
    return [
        RangeSlider::make('Age',  'age')
    ];
}

//...
```
