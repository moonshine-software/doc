<x-page
    title="MoonShine Component"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#create', 'label' => 'Создание компонента'],
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#name', 'label' => 'Имя компонента'],
            ['url' => '#view_data', 'label' => 'Передача данных'],
            ['url' => '#attributes', 'label' => 'Атрибуты'],
            ['url' => '#custom-view', 'label' => 'Изменение отображения'],
            ['url' => '#can-see', 'label' => 'Условие отображения'],
            ['url' => '#when-unless', 'label' => 'Методы по условию'],
            ['url' => '#render', 'label' => 'Render'],
            ['url' => '#alpinejs', 'label' => 'AlpineJs'],
        ]
    ]"
>

<x-sub-title id="create">Создание компонента</x-sub-title>

<x-p>
    В <strong>MoonShine</strong> реализована консольная команда для создания <em>MoonShineComponent</em>,
    в котором уже реализованы основные методы для использования в админ панели.
</x-p>

<x-code language="shell">
php artisan moonshine:component
</x-code>

<x-p>
    В результате будет создан класс <code>NameComponent</code>, который является основой нового компонента.<br />
    Располагается он, по умолчанию, в директории <code>app/MoonShine/Components</code>.<br />
    А так же Blade файл для компонента в директории <code>resources/views/admin/components</code>.
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Метод <code>make()</code> предназначен для создания экземпляра компонента.
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

<x-sub-title id="name">Имя компонента</x-sub-title>

<x-p>
    Метод <code>name()</code> позволяет задать уникальное имя для экземпляра, через которое можно будет вызывать события компонента.
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

<x-sub-title id="view_data">Передача данных</x-sub-title>

<x-p>
    Метод <code>viewData()</code> позволяет передать данные в шаблон компонента.
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

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Для экземпляра компонента можно указать атрибуты используя метод <code>customAttributes()</code>.
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

<x-sub-title id="custom-view">Изменение отображения</x-sub-title>

<x-p>
    Когда необходимо изменить view с помощью <em>fluent interface</em>
    можно воспользоваться методом <code>customView()</code>.
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

<x-sub-title id="can-see">Условие отображения</x-sub-title>

<x-p>
    Отображать компонент можно по условию, воспользовавшись методом <code>canSee()</code>.
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

<x-sub-title id="when-unless">Методы по условию</x-sub-title>

<x-p>
    Метод <code>when()</code> реализует <em>fluent interface</em>
    и выполнит callback, когда первый аргумент, переданный методу, имеет значение true.
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
    Экземпляр компонента, будет передан в функции callback.
</x-moonshine::alert>

<x-p>
    Методу <code>when()</code> может быть передан второй callback, он будет выполнен,
    когда первый аргумент, переданный методу, имеет значение false.
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
    Метод <code>unless()</code> обратный методу <code>when()</code> и выполнит первый callback,
    когда первый аргумент имеет значение false, иначе будет выполнен второй callback, если он передан методу.
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
    Метод <code>render()</code> позволяет получить отрендеренный компонент.
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
    Также рекомендуем ознакомиться с AlpineJs и использовать всю мощь этого js фреймворка.
</x-p>

<x-p>
    Вы можете использовать его реактивность, давайте посмотрим как удобно создать компонент:
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
