# MorphMany

Extends [HasMany](https://moonshine-laravel.com/docs/resource/fields/fields-has_many)
* has the same features    

Relationship field in Laravel of type morphMany

Same as `MoonShine\Fields\Relationships\HasMany` only for morphMany relationships  
`MoonShine\Fields\Relationships\MorphMany`

To create this field, use the static `make()` method.

```php
MorphMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
```

- `label` - label, field header,
- `relationName` - name of the relationship
- `formatted` - a closure or field in a related table to display values.

> [!CAUTION]
> The `formatted` parameter is not used in the `MorphMany` field!

```php
use MoonShine\Fields\Relationships\MorphMany;

//...

public function fields(): array
{
    return [
        MorphMany::make('Comments', 'comments')
    ];
}

//...
```
