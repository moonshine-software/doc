# Slug 

- [Основы](#basics)  
- [Генерация slug](#from)  
- [Разделитель](#separator)  
- [Локаль](#locale)  
- [Уникальное значение](#unique)  
- [Живой slug](#live) 

--- 

Расширяет [Text](/docs/{{version}}/fields/text)
* имеет те же функции

> [!INFO]
> Поле зависит от модели Eloquent

<a name="basics"></a>  
## Основы  

Используя это поле, вы можете генерировать slug на основе выбранного поля, а также хранить только уникальные значения.  

```php
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
    ];
}

//...
```

![slug](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/slug.png)
![slug_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/slug_dark.png)


<a name="from"></a>  
## Генерация slug  

Используя метод `from()`, вы можете указать, на основе какого поля модели генерировать slug, если значение отсутствует.  

```php
from(string $from)
```

```php
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->from('title')
    ];
}

//...
```

<a name="separator"></a>  
## Разделитель  

По умолчанию в качестве разделителя слов при генерации slug используется `-`. Метод `separator()` позволяет изменить это значение.  

```php
separator(string $separator)
```

```php
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->separator('_')
    ];
}

//...
```

<a name="locale"></a>  
## Локаль  

По умолчанию генерация *slug* учитывает указанную локаль приложения. Метод `locale()` позволяет изменить это поведение для поля.  

```php
locale(string $local)
```

```php
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->locale('ru')
    ];
}

//...
```


<a name="unique"></a>  
## Уникальное значение  

Если вам нужно сохранять только уникальные slug, необходимо использовать метод `unique()`.  

```php
unique()
```

```php
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->unique()
    ];
}

//...
```

<a name="live"></a>  
## Живой slug  

Метод `live()` позволяет создать живое поле, которое будет отслеживать изменения в исходном поле.  

```php
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->reactive(),
        Slug::make('Slug')
            ->from('title')
            ->live()
    ];
}

//...
```

> [!NOTE]
> Живое поле основано на [реактивности полей](https://moonshine-laravel.com/docs/resource/fields/fields-index#reactive).
