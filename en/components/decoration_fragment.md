https://moonshine-laravel.com/docs/resource/components/components-decoration_fragment?change-moonshine-locale=en

------
# Decoration Fragment

-[Make](#make)
-[Asynchrinous event](#async)

<a name="make"></a>
### Make

Sometimes you need to return only part of a template in your HTTP response. For this, you can use [Blade Fragments](https://laravel.com/docs/blade#rendering-blade-fragments). The *Fragment* decorator allows you to create corresponding blocks.

You can create a *Fragment* using the static `make()` method.

```php
make(array $fields = [])
```

Method `name()` sets the name for the fragment.

```php
use MoonShine\Decorations\Fragment;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Fragment::make([
            Text::make('Name', 'first_name')
        ])
            ->name('fragment-name')
    ];
}

//...
```


<a name="async"></a>
### Asynchronous event

You can incorporate an area in a Fragment and set an event on this area,
by calling which it will be possible to update the fragment

```php
Fragment::make($fields)
    ->name('fragment-name'),
```
And as an example, let's call an event for successful submission of the form
    
```php
FormBuilder::make()->async(asyncEvents: 'fragment-updated-fragment-name')
```

You can also pass additional parameters with the request via an array
    
```php
Fragment::make($fields)
    ->name('fragment-name')
    ->updateAsync(['resourceItem' => request('resourceItem')]),
```

#### Passing parameters

The `withParams()` method allows you to pass field values with the request using element selectors.

```php
Fragment::make($fields)
    ->withParams([
        'start_date' => '#start_date',
        'end_date' => '#end_date'
    ])
    ->name('fragment-name'),
```
