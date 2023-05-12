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
        <x-moonshine::link href="#">Read more</x-moonshine::link>
    </x-slot:actions>
</x-moonshine::card>
