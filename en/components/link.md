https://moonshine-laravel.com/docs/resource/components/components-link?change-moonshine-locale=en

------
# Link Component

- [Make](#make)
- [Icon](#icon)
- [Badge](#badge)
- [Button](#button)
- [Filled](#filled)
- [Tooltip](#tooltip)

<a name="make"></a>
## Make

The *Link* component allows links.
You can create a *Link* using the static `make()` method class `Link`.

```php
make(Closure|string $href, Closure|string $label = '')
```

- `$href` - link url,
- `$label` - title. 

```php
use MoonShine\Components\Link;

//...

public function components(): array
{
    return [
        Link::make(
            '/endpoint',
            'Link'
        )
    ];
}

//...
```
<a name="icon"></a>
## Icon

The `icon()` method allows you to specify an icon for a link.
                
```php
icon(string $icon)
```

```php
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Edit')
    ->icon('heroicons.outline.pencil')

//...
```

<a name="badge"></a>
## Badge

The `badge()` method allows you to add a badge to a link.
                    
```php
badge(Closure|string|int|float|null $value)
```
                        
```php
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Comments')
    ->badge(fn() => Comment::count())
//...
```

<a name="button"></a>
## Button        
              
The `button()` method allows you to display a link as a button.
 ```php
 button()
 ```

 ```php
 use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->button()

//...
```

<a name="filled"></a>
## Filled
               
The `filled()` method sets the fill for the link.
    
```php
filled()
```
                         
```php
use MoonShine\Components\Link;
//...
Link::make('/endpoint', 'Link')
    ->filled()

//...
```

<a name="tooltip"></a>
## Tooltip   

The `tooltip()` method allows you to set a tooltip for a link.        
                  
```php
tooltip(?string $tooltip = null)
```
                         
```php
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->tooltip('Tooltip for link')

//...
```
