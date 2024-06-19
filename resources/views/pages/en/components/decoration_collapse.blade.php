<x-page
    title="Decorator Collapse"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#show', 'label' => 'Show'],
            ['url' => '#persist', 'label' => 'Persist'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Collapse</em> decorator allows you to collapse the block contents while maintaining the state.
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
    By default, the <em>Collapse</em> decorator is displayed as collapsed.
    The <code>show()</code> method allows you to override this behavior.
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
    By default, the <em>Collapse</em> remembers the state, but there are times when it is not worth doing this.
    The <code>persist()</code> method allows you to override this behavior.
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
