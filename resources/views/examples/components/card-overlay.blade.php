<x-moonshine::card
    url="#"
    :overlay="true"
    thumbnail="/images/image_1.jpg"
    :title="fake()->sentence(3)"
    :subtitle="date('d.m.Y')"
    :values="['ID' => 1, 'Author' => fake()->name()]"
>
    <x-slot:header><!-- [tl! focus:-8] -->
        <x-moonshine::badge color="green">new</x-moonshine::badge>
    </x-slot:header><!-- [tl! focus] -->

    {{ fake()->text() }}

    <x-slot:actions><!-- [tl! focus] -->
        <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
    </x-slot:actions><!-- [tl! focus:1] -->
</x-moonshine::card>
