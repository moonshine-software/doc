https://moonshine-laravel.com/docs/resource/ui-components/ui-modal?change-moonshine-locale=en

------

# Modal

- [Basics](#basics)
- [Wide Window](#wide)
- [Automatic widht](#auto)
- [Closing a window](#close)
- [Asynchronous Content](#async)

<a name="basics"></a>
# Basics

To create modal windows, the `moonshine::modal` component is used.

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
## Wide window

The `wide` parameter allows modal windows to fill the entire width.

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
## Automatic width

The `auto` parameter allows modal windows to take up width based on the content.

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
## Closing a window

By default, modal windows close when clicked outside the window area. You can override this behavior using the `closeOutside` parameter.

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
## Asynchronous Content

The `moonshine::modal` component allows you to load content asynchronously.

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
