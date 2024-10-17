# MorphOne

Extends [HasOne](https://moonshine-laravel.com/docs/resource/fields/fields-has_one)
* has the same features  

Relationship field in Laravel of type morphOne.

Same as `MoonShine\Fields\Relationships\HasOne` only for MorphOne relationships  
`MoonShine\Fields\Relationships\MorphOne`.

To create this field, use the static `make()` method.

```php
MorphOne::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
```

- `label` - label, field header 
- `relationName` - name of the relationship  
- `formatted` - a closure or field in a related table to display values.  

```php
use MoonShine\Fields\Relationships\MorphOne;

//...

public function fields(): array
{
    return [
        MorphOne::make('Profile', 'profile')
    ];
}

//...
```
