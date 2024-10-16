# Checkbox

- [Make](#make)
- [On/off values](#on-off)
- [Editing in preview](#editing-in-preview)

---

<a name="make"></a>
## Make
The *Checkbox* field includes all the basic methods.

```php
use MoonShine\Fields\Checkbox; 
 
//...
 
public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish') 
    ];
}
 
//...
```
 
<a name="on-off"></a>
## On/off values

By default, the field has the values `1` and `0` for the selected and unselected states, respectively. The `onValue()` and `offValue()` methods allow you to override these values.

```php
onValue(int|string $onValue)
```

```php
offValue(int|string $onValue)
```

```php
use MoonShine\Fields\Checkbox;
 
//...
 
public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish')
            ->onValue('yes')
            ->offValue('no')
    ];
}
 
//...

```

<a name="editing-in-preview"></a>
## Editing in preview
The `updateOnPreview()` method allows you to edit the *Checkbox* field in *preview* mode.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```
-`$url` - url for asynchronous request processing,
-`$resource` - model resource referenced by the relationship,
-`$condition` - method run condition.

> [!TIP]
> The settings are not required and must be passed if the field is running out of resource.

```php
use MoonShine\Fields\Checkbox;

//...

public function fields(): array
{
    return [
        Checkbox::make(Public)
            ->updateOnPreview()
    ];
}

//...
```
