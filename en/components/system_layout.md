https://moonshine-laravel.com/docs/resource/components/components-system_layout?change-moonshine-locale=en 

------ 

# System component Layout

-  [Make](#make) 
-  [Blade](#blade)  

<a name="make"></a>
## Make

The *Layout* system component serves as the basis for building any page in **MoonShine**. It includes the `body` tag and basic markup elements, as well as the necessary classes and scripts. 

You can create a *Layout* using the static `make()` method class `LayoutBuilder`.

```php 
make(array $components = []) 
```

```php 

use MoonShine\Components\LayoutBuilder
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            // ...
        ]);
    }
}
```

<a name="blade"></a>
## Blade

The component can be used in *html* markup:

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :class="$store.darkMode.on && 'dark'"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @moonShineAssets
</head>
<x-moonshine::layout>
    //...
</x-moonshine::layout>
</html>
```
