https://moonshine-laravel.com/docs/resource/components/components-decoration_heading?change-moonshine-locale=en

------

# Decoration Heading

-[Make](#make)
-[Gradation](#gradation)
-[Tag](##custom-tag)

<a name="make"></a>
## Make

The *Heading* decorator allows you to add headings to the content.

You can create a *Heading* by using the static method `make()` by passing the text heading to it.

```php
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Heading::make('Title/Slug'),
        Text::make('Title'),
        Text::make('Slug'),
    ];
}

//...
```

![has_many](https://moonshine-laravel.com/screenshots/heading.png)
![has_many](https://moonshine-laravel.com/screenshots/heading_dark.png)

<a name="gradation"></a>
## Gradation


```php
h(int $gradation = 3, $asClass = true)
```

The method allows you to wrap content in a tag *h1 - h6*.
The first parameter determines the gradation of the tag, the second determines whether to use a tag or a class.

```php
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Text;

//...


public function components(): array
{
    return [
        // There will be tags h1 - h4
        Heading::make('Dashboard')->h(1, false),
        Heading::make('MoonShine')->h(2, false),
        Heading::make('Demo version')->h(asClass: false),
        Heading::make('Heading')->h(4, false),

        // There will be div.h1 - div.h4
        Heading::make('Dashboard')->h(1),
        Heading::make('MoonShine')->h(2),
        Heading::make('Demo version')->h(), // h3
        Heading::make('Heading')->h(4),
    ];
}

//...
```

<a name="custom-tag"></a>
## Tag

```php
tag(string $tag)
```

The method allows you to wrap content in a specified tag.

```php
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        // There will be p.h1 - p.h4
        Heading::make('Dashboard')->tag('p')->h(1),
        Heading::make('MoonShine')->tag('p')->h(2),
        Heading::make('Demo version')->tag('p')->h(),
        Heading::make('Heading')->tag('p')->h(4),
    ];
}

//...
```
