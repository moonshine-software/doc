# MoonShineComponent

- [Создание компонента](#create)
- [Создание экземпляра](#make)
- [Имя компонента](#name)
- [Данные представления](#view_data)
- [Атрибуты](#attributes)
- [Пользовательское представление](#custom-view)
- [Условия отображения](#can-see)
- [Методы по условию](#when-unless)
- [Рендеринг](#render)
- [AlpineJs](#alpinejs)

---

<a name="creating"></a>
## Создание компонента
**MoonShine** реализует консольную команду для создания *MoonShineComponent*, которая уже реализует базовые методы для использования в админ-панели.

```php
php artisan moonshine:component
```

В результате будет создан класс `NameComponent`, который является основой нового компонента. По умолчанию он располагается в директории `app/MoonShine/Components`.  
А также Blade-файл для компонента в директории `resources/views/admin/components`.

<a name="make"></a>
## Создание экземпляра
Метод `make()` используется для создания экземпляра компонента.

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
## Имя компонента

Метод `name()` позволяет установить уникальное имя для экземпляра, через которое можно вызывать события компонента.

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
## Данные представления

Метод `viewData()` позволяет передать данные в шаблон компонента.

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
## Атрибуты

Для экземпляра компонента можно указать атрибуты с помощью метода `customAttributes()`.

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
## Пользовательское представление

Когда необходимо изменить представление, используя *fluent interface*, можно использовать метод `customView()`.

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
## Условия отображения

Вы можете отображать компонент на основе условий, используя метод `canSee()`.

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
## Методы по условию

Метод `when()` реализует *fluent interface* и выполнит обратный вызов, когда первый аргумент, переданный методу, будет оценен как истинный.

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
> В функцию обратного вызова будет передан экземпляр компонента.

Второй обратный вызов может быть передан методу `when()`, он будет выполнен, когда первый аргумент, переданный методу, будет ложным.

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

Метод `unless()` является обратным методу `when()` и выполнит первый обратный вызов, когда первый аргумент ложен, в противном случае будет выполнен второй обратный вызов, если он передан методу.

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
## Рендеринг

Метод `render()` позволяет получить отрендеренный компонент.

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

Мы также рекомендуем вам ознакомиться с AlpineJs и использовать всю мощь этого js-фреймворка.

Вы можете использовать его реактивность, давайте посмотрим, как удобно создать компонент:

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
