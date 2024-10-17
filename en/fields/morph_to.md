# MorphTo

Extends [BelongsTo](https://moonshine-laravel.com/docs/resource/fields/fields-belongs_to)
* has the same features    

MorphTo relationship field in Laravel

Same as `MoonShine\Fields\Relationships\BelongsTo` only for MorphTo relationships

```php
use MoonShine\Fields\Relationships\MorphTo; 
 
//...
 
public function fields(): array
{
    return [
        MorphTo::make('Commentable')->types([
            Article::class => 'title'
        ]), 
    ];
}
//...
```

![morph_to](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to.png)
![morph_to_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to_dark.png)

> [!TIP]
> Required `types` method indicating the available classes.

Description of the value of the `types` method:

The key is a reference to the model
The value is a string or an array.

> [!TIP]
> If the value is passed as a string, it should indicate the name of the field to be displayed. If it is passed as an array, then the first element of the array is the name of the field to display, and the second is the name of the relationship instead of the name of the model.
>


```php
use MoonShine\Fields\Relationships\MorphTo; 
 
//...
 
public function fields(): array
{
    return [
        MorphTo::make('Imageable')->types([
            Company::class => ['short_name', 'Organization']
        ]), 
    ];
}
//...
```

![morph_to_array](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to_array.png)
![morph_to_array_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to_array_dark.png)
