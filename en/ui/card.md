https://moonshine-laravel.com/docs/resource/ui-components/ui-card?change-moonshine-locale=en

------

## Card

- [Card](#card)
- [Basics](#basics)
- [Overlay mode](#overlay-mode)
- [Image carousel](#image-carousel)

<a name="basics"></a>
### Basics

To create cards in the admin panel, use the `moonshine::card` component.

```php
<x-moonshine::card
    url="#"
    thumbnail="/images/image_1.jpg"
    :title="fake()->sentence(3)"
    :subtitle="date('d.m.Y')"
    :values="['ID' => 1, 'Author' => fake()->name()]"
>
    <x-slot:header>
        <x-moonshine::badge color="green">new</x-moonshine::badge>
    </x-slot:header>

    {{ fake()->text() }}

    <x-slot:actions>
        <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
    </x-slot:actions>
</x-moonshine::card>
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="overlay"></a>
### Overlay mode

The `overlay` mode is available for the card.

```php
<x-moonshine::card
    url="#"
    :overlay="true"
    thumbnail="/images/image_1.jpg"
    :title="fake()->sentence(3)"
    :subtitle="date('d.m.Y')"
    :values="[ 'ID' => 1, 'Author' => fake()->name() ]"
>
    <x-slot:header>
        <x-moonshine::badge color="green">new</x-moonshine::badge>
    </x-slot:header>

    {{ fake()->text() }}

    <x-slot:actions>
        <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
    </x-slot:actions>
</x-moonshine::card>
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="carousel"></a>
### Image carousel

To add an images carousel to a card, you can add to `thumbnail` parameter array of images.

```php
<x-moonshine::card
    url="#"
    :overlay="true"
    :thumbnail="[ '/images/image_1.jpg', '/images/image_2.jpg' ]"
    :title="fake()->sentence(3)"
    :subtitle="date('d.m.Y')"
    :values="[ 'ID' => 1, 'Author' => fake()->name() ]"
>
    <x-slot:header>
        <x-moonshine::badge color="green">new</x-moonshine::badge>
    </x-slot:header>

    {{ fake()->text() }}

    <x-slot:actions>
        <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
    </x-slot:actions>
</x-moonshine::card>
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)
