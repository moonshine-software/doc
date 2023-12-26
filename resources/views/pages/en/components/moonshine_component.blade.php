<x-page
    title="MoonShine Component"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#create', 'label' => 'Creating'],
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#name', 'label' => 'Component name'],
            ['url' => '#view_data', 'label' => 'View data'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#custom-view', 'label' => 'Custom view'],
            ['url' => '#can-see', 'label' => 'Can see'],
            ['url' => '#when-unless', 'label' => 'Methods by condition'],
            ['url' => '#render', 'label' => 'Render'],
            ['url' => '#alpinejs', 'label' => 'AlpineJs'],
        ]
    ]"
>

<x-sub-title id="create">Creating a component</x-sub-title>

<x-p>
    <strong>MoonShine</strong> implements a console command to create a <em>MoonShineComponent</em>,
    which already implements the basic methods for use in the admin panel.
</x-p>

<x-code language="shell">
php artisan moonshine:component
</x-code>

<x-p>
    As a result, the <code>NameComponent</code> class will be created, which is the basis of the new component.<br />
    It is located, by default, in the <code>app/MoonShine/Components</code> directory.<br />
    And also the Blade file for the component in the <code>resources/views/admin/components</code> directory.
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <code>make()</code> method is used to create an instance of a component.
</x-p>

<x-code language="php">
use App\MoonShine\Components\MyComponent; // [tl! focus]

//...

public function components(): array
{
    return [
        MyComponent::make() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="name">Component name</x-sub-title>

<x-p>
    The <code>name()</code> method allows you to set a unique name for the instance, through which component events can be called.
</x-p>

<x-code language="php">
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->name('my-component') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="view_data">View data</x-sub-title>

<x-p>
    The <code>viewData()</code> method allows you to pass data to the component template.
</x-p>

<x-code language="php">
namespace App\MoonShine\Components;

//...

final class MyComponent extends MoonShineComponent
{
    protected function viewData(): array
    {
        return [];
    } // [tl! focus:-3]
}

//...
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    For a component instance, you can specify attributes using the <code>custom Attributes()</code> method.
</x-p>

<x-code language="php">
customAttributes(array $attributes)
</x-code>

<x-code language="php">
use App\MoonShine\Components\MyComponent; // [tl! focus]

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->customAttributes(['class' => 'mt-4']) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="custom-view">Custom view</x-sub-title>

<x-p>
    When you need to change the view using <em>fluent interface</em>
    you can use the <code>customView()</code> method.
</x-p>

<x-code language="php">
customView(string $customView)
</x-code>

<x-code language="php">
use App\MoonShine\Components\MyComponent; // [tl! focus]

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->customView('components.my-component') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="can-see">Can see</x-sub-title>

<x-p>
    You can display a component based on conditions using the <code>canSee()</code> method.
</x-p>

<x-code language="php">
canSee(Closure $callback)
</x-code>

<x-code language="php">
use App\MoonShine\Components\MyComponent; // [tl! focus]

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->canSee(function(Request $request) {
                return $request->user('moonshine')?->id === 1;
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="when-unless">Methods by condition</x-sub-title>

<x-p>
    The <code>when()</code> method implements the <em>fluent interface</em>
    and will execute a callback when the first argument passed to the method evaluates to true.
</x-p>

<x-code language="php">
when($value = null, callable $callback = null)
</x-code>

<x-code language="php">
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->when(
                fn() => request()->user('moonshine')?->id === 1,
                fn($component) => $component->canSee(fn() => false)
            ) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The component instance will be passed to the callback function.
</x-moonshine::alert>

<x-p>
    The second callback can be passed to the <code>when()</code> method, it will be executed,
    when the first argument passed to the method is false.
</x-p>

<x-code language="php">
when($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-code language="php">
use App\MoonShine\Components\MyComponent;

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->when(
                fn() => request()->user('moonshine')?->id === 1,
                fn($component) => $component->customView('components.my-component-admin')
                fn($component) => $component->customView('components.my-component')
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    The <code>unless()</code> method is the inverse of the <code>when()</code> method and will execute the first callback,
    when the first argument is false, otherwise the second callback will be executed if it is passed to the method.
</x-p>

<x-code language="php">
unless($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-code language="php">
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
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-sub-title id="render">Render</x-sub-title>

<x-p>
    The <code>render()</code> method allows you to get the rendered component.
</x-p>

<x-code language="php">
use App\MoonShine\Components\MyComponent; // [tl! focus]

//...

public function components(): array
{
    return [
        MyComponent::make()
            ->render() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="alpinejs">AlpineJs</x-sub-title>

<x-p>
    We also recommend that you familiarize yourself with AlpineJs and use the full power of this js framework.
</x-p>

<x-p>
    You can use its reactivity, let's see how to conveniently create a component:
</x-p>

<x-code language="html">
<div x-data="myComponent">
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("myComponent", () => ({
            init() {

            },
        }))
    })
</script>
</x-code>

</x-page>
