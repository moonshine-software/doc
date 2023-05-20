<x-page
    title="Divider"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#label', 'label' => 'Label'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To divide into areas, you can use the <code>Divider</code> decorator
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
    You can use text as a separator, for this you need to pass it to the <code>make()</code> method
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
    The <code>centered()</code> method allows you to center the text
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
