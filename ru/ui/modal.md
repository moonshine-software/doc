# Модальное окно

- [Основы](#basics)
- [Широкое окно](#wide)
- [Автоматическая ширина](#auto)
- [Закрытие окна](#close)
- [Асинхронный контент](#async)

---

<a name="basics"></a>
## Основы

Для создания модальных окон используется компонент `moonshine::modal`.

```php
<x-moonshine::modal title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="wide"></a>
## Широкое окно

Параметр `wide` позволяет модальным окнам заполнять всю ширину.

```php
<x-moonshine::modal wide title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open wide modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="auto"></a>
## Автоматическая ширина

Параметр `auto` позволяет модальным окнам занимать ширину на основе содержимого.

```php
<x-moonshine::modal auto title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open auto modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="=close"></a>
## Закрытие окна

По умолчанию модальные окна закрываются при клике вне области окна. Вы можете переопределить это поведение с помощью параметра `closeOutside`.

```php
<x-moonshine::modal :closeOutside="false" title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="async"></a>
## Асинхронный контент

Компонент `moonshine::modal` позволяет загружать контент асинхронно.

```php
<x-moonshine::modal
    async
    :asyncUrl="route('async')"
    title="Title"
>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open async modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```
