https://moonshine-laravel.com/docs/resource/fields/fields-has_one?change-moonshine-locale=en

------
# HasOne

[Basics](#basics)
[Fields](#fields)
[Parent-ID](#parent-id)

<a name="basics"></a>
### Basics

The *HasOne* field is designed to work with the relation of the same name in Laravel and includes all the basic methods.

To create this field, use the static `make()` method.

```php
HasOne::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
```

`$label` - label, field header,
`$relationName` - name of the relationship,
`$resource` - the model resource referenced by the relation

> [!CAUTION]
> The `$formatted` parameter is not used in the HasOne field!

> [!WARNING]
> The presence of the model resource referenced by the relation is mandatory!  
> The resource also needs to be [registered](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) with the service provider *MoonShineServiceProvider* in the method `menu()` or `resources()`. Otherwise, there will be a 404 error.

```php
use MoonShine\Fields\Relationships\HasOne; 
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Profile', 'profile', resource: new ProfileResource()) 
    ];
}
 
//...

```

![has_one](https://moonshine-laravel.com/screenshots/has_one.png)
![has_one_dark](https://moonshine-laravel.com/screenshots/has_one_dark.png)

> [!TIP]
> If you do not specify `$relationName`, then the relation name will be determined automatically based on `$label`.

```php
use MoonShine\Fields\Relationships\HasOne; 
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Profile', resource: new ProfileResource()) 
    ];
}
 
//...
```

> [!TIP]
> You can omit `$resource` if the model resource matches the name of the relationship.

```php
use MoonShine\Fields\Relationships\HasOne; 
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Profile', 'profile') 
    ];
}
 
//...
```

<a name="fields"></a>
### Fields

The `fields()` method allows you to specify which fields will participate in *preview* or in building forms.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Contacts', resource: new ContactResource())
            ->fields([
                Phone::make('Phone'),
                Text::make('Address'),
            ]) 
    ];
}
 
//...
```
![has_one_preview](https://moonshine-laravel.com/screenshots/has_one_preview.png)

![has_one_preview_dark](https://moonshine-laravel.com/screenshots/has_one_preview_dark.png)

<a name="parent-id"></a>
### Parent ID

If the relationship has a resource and you want to get the ID of the parent element, then you can use the *ResourceWithParent* trait.

```php
use MoonShine\Resources\ModelResource;
use MoonShine\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    //...
}
```

When using a trait, it is necessary to define methods:

```php
protected function getParentResourceClassName(): string
{
    return PostResource::class;
}

protected function getParentRelationName(): string
{
    return 'post';
}
```

To get the parent ID, use the `getParentId()` method.

```
$this->getParentId();
```

> [!TIP]
> Recipe: [saving files](https://moonshine-laravel.com/docs/resource/recipes/recipes#hasmany-parent-id) _HasMany_ connections in the directory with the parent ID.
