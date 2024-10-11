# Card

- [Основы](#basics)
- [Режим наложения](#overlay-mode)
- [Карусель изображений](#image-carousel)

---

<a name="basics"></a>
## Основы

Для создания карточек в админ-панели используйте компонент `moonshine::card`.

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
## Режим наложения

Для карточки доступен режим `overlay`.

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
## Карусель изображений

Чтобы добавить карусель изображений в карточку, вы можете добавить в параметр `thumbnail` массив изображений.

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
