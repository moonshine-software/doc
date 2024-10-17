# MorphToMany

Extends [BelongsToMany](https://moonshine-laravel.com/docs/resource/fields/fields-belongs_to_many) 
* has the same features

MorphToMany relationship field in Laravel

Same as `MoonShine\Fields\Relationships\BelongsToMany` only for MorphToMany relationships `MoonShine\Fields\Relationships\MorphToMany`.

To create this field, use the static `make()` method.

```php
MorphToMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
```

- `label` - label, field header
- `relationName` - name of the relationship
- `formatted` - a closure or field in a related table to display values.

```php
use MoonShine\Fields\Relationships\MorphToMany;

//...

public function fields(): array
{
    return [
        MorphToMany::make('Categories', 'categories')
    ];
}

//...
```
