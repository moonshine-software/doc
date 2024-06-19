<x-page
    title="Декоратор Collapse"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#show', 'label' => 'Show'],
            ['url' => '#persist', 'label' => 'Persist'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Декоратор <em>Collapse</em> позволяет сворачивать содержимое блока с сохранением состояния.
</x-p>

<x-code language="php">
make(Closure|string|array $labelOrFields = '', array $fields = [])
</x-code>

<x-code language="php">
use MoonShine\Decorations\Collapse; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Title/Slug', [ // [tl! focus]
            Text::make('Title'),
            Text::make('Slug')
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/collapse.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/collapse_dark.png') }}"></x-image>

<x-sub-title id="show">Show</x-sub-title>

<x-p>
    По умолчанию декоратор <em>Collapse</em> отображается в свернутом состоянии.
    Метод <code>show()</code> позволяет переопределить это поведение.
</x-p>

<x-code language="php">
show(bool $show = true)
</x-code>

<x-code language="php">
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Title/Slug', [
            Text::make('Title'),
            Text::make('Slug')
        ])
            ->show() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="persist">Persist</x-sub-title>

<x-p>
    По умолчанию декоратор <em>Collapse</em> запоминает состояние, но бывают случаи, когда этого делать не стоит.
    Метод <code>persist()</code> позволяет переопределить это поведение.
</x-p>

<x-code language="php">
    persist(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Title/Slug', [
            Text::make('Title'),
            Text::make('Slug')
        ])
            ->persist(fn () => false) // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
