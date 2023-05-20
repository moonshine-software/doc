<x-page
    title="Разделитель"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#label', 'label' => 'Label'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для разделения на зоны можно воспользоваться декорацией <code>Divider</code>
</x-p>

<x-code language="php">
use MoonShine\Decorations\Divider;

//...
public function fields(): array
{
    return [
        //...
        Divider::make(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/divider.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/divider_dark.png') }}"></x-image>

<x-sub-title id="label">Label</x-sub-title>

<x-p>
    В качестве разделителя можно использовать текст, для этого его необходимо передать методу <code>make()</code>
</x-p>

<x-code language="php">
use MoonShine\Decorations\Divider;

//...
public function fields(): array
{
    return [
        //...
        Divider::make('Divider'), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/divider_label.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/divider_label_dark.png') }}"></x-image>

<x-p>
    Метод <code>centered()</code> позволяет отцентрировать текст
</x-p>

<x-code language="php">
use MoonShine\Decorations\Divider;

//...
public function fields(): array
{
    return [
        //...
        Divider::make('Divider')
            ->centered(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/divider_label_center.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/divider_label_center_dark.png') }}"></x-image>

</x-page>
