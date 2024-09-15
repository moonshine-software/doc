https://moonshine-laravel.com/docs/resource/components/components-moonshine_component?change-moonshine-locale=en

------
# MoonShineComponent

-[Creating a component](#create)
-[Make](#make)
-[Component name](#name)
-[View Data](#view_data)
-[Attributes](#attributes)
-[Custom view](#custom-view)
-[Can see](#can-see)
-[Mehtods by condition](#when-unless)
-[Render](#render)
-[AlpineJs](#alpinejs)

<a name="creating"></a>
## Creating a component
**MoonShine** implements a console command to create a *MoonShineComponent*, which already implements the basic methods for use in the admin panel.

```php
php artisan moonshine:component
```

As a result, the `NameComponent` class will be created, which is the basis of the new component.It is located, by default, in the `app/MoonShine/Components` directory.  
And also the Blade file for the component in the `resources/views/admin/components` directory.

<a name="make"></a>
## Make
The `make()` method is used to create an instance of a component.

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
    ];
}

//...
```

<a name="component-name"></a>
## Component name

The `name()` method allows you to set a unique name for the instance, through which component events can be called.

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->name('my-component')
    ];
}

//...
```

<a name="view-data"></a>
## View data

The `viewData()` method allows you to pass data to the component template.

```php
namespace App\MoonShine\Components;

//...

final class MyComponent extends MoonShineComponent
{
    protected function viewData(): array
    {
        return [];
    }
}

//...
```

<a name="attributes"></a>
## Attributes

For a component instance, you can specify attributes using the `customAttributes()` method.

```php
customAttributes(array $attributes)
```

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->customAttributes(['class' => 'mt-4'])
    ];
}

//...
```

<a name="custom-view"></a>
## Custom view

When you need to change the view using *fluent interface* you can use the `customView()` method.


```php
customView(string $customView)
```


```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->customView('components.my-component')
    ];
}

//...
```


<a name="can-see"></a>
## Can see

You can display a component based on conditions using the `canSee()` method.

```php
canSee(Closure $callback)
```

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->canSee(function(Request $request) {
                return $request->user('moonshine')->id === 1;
            })
    ];
}

//...
```

<a name="methods-by-condition"></a>
## Methods by condition

The `when()` method implements the *fluent interface* and will execute a callback when the first argument passed to the method evaluates to true.

```php
when($value = null, callable $callback = null)
```

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->when(
                fn() => request()->user('moonshine')->id === 1,
                fn($component) => $component->canSee(fn() => false)
            )
    ];
}

//...
```

> [!NOTE]
> The component instance will be passed to the callback function.

The second callback can be passed to the `when()` method, it will be executed, when the first argument passed to the method is false.

```php
when($value = null, callable $callback = null, callable $default = null)
```

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->when(
                fn() => request()->user('moonshine')->id === 1,
                fn($component) => $component->customView('components.my-component-admin'),
                fn($component) => $component->customView('components.my-component')
            )
    ];
}

//...
```

The `unless()` method is the inverse of the `when()` method and will execute the first callback, when the first argument is false, otherwise the second callback will be executed if it is passed to the method.

```php
unless($value = null, callable $callback = null, callable $default = null)
```

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->unless(
                fn() => request()->user('moonshine')?->id === 1,
                fn($component) => $component->customView('components.my-component')
                fn($component) => $component->customView('components.my-component-admin')
            )
    ];
}

//...
```

<a name="render"></a>
## Render

The `render()` method allows you to get the rendered component.

```php
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->render()
    ];
}

//...
```

<a name="alpinejs"></a>
## AlpineJs

We also recommend that you familiarize yourself with AlpineJs and use the full power of this js framework.

You can use its reactivity, let's see how to conveniently create a component:

```html
<div x-data="myComponent">

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("myComponent", () => ({
            init() {

            },
        }))
    })
</script>
```
