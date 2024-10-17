# Slug 

- [Basics](#basics)  
- [Slug generation](#from)  
- [Delimiter](#separator)  
- [Locale](#locale)  
- [Unique value](#unique)  
- [Live slug](#live)  

---

Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
* has the same features

> [!INFO]
> Field depends on Eloquent Model

<a name="basics"></a>  
## Basics  

Using this field you can generate a slug based on the selected field, and also store only unique values.  

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
## Slug generation  

Using the `from()` method, you can specify based on which model field to generate a slug, if there is no value.  

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
## Delimiter  

By default, `-` is used as a word separator when generating a slug. The `separator()` method allows you to change this value.  

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
## Locale  

By default, *slug* generation takes into account the specified application locale, The `locale()` method allows you to change this behavior for a field.  

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
## Unique value  

If you need to save only unique slugs, you need to use the `unique()` method.  

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
## Live slug  

The `live()` method allows you to create a live field that will track changes to the original field.  

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
> Lives is based on [field reactivity](https://moonshine-laravel.com/docs/resource/fields/fields-index#reactive).
