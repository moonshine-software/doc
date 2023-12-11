<x-page
    title="Decorator Fragment"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#async', 'label' => 'Asynchronous event'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Sometimes you may want to return only part of a template in your HTTP response. For this you can use
    <x-link link="https://laravel.com/docs/blade#rendering-blade-fragments" target="_blank">Blade Fragments</x-link>.<br />
    The <em>Fragment</em> decorator allows you to create corresponding blocks.
</x-p>

<x-p>
    You can create a <em>Fragment</em> using the static <code>make()</code> method.
</x-p>

<x-code language="php">
make(array $fields = [])
</x-code>

<x-p>
    The <code>name()</code> method sets the name for the fragment.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Fragment; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Fragment::make([ // [tl! focus]
            Text::make('Name', 'first_name')
        ])
            ->name('fragment-name') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="async">Asynchronous event</x-sub-title>

<x-p>
    You can wrap an area in a Fragment and hang an event on this area,
    by calling which it will be possible to update the fragment
</x-p>

<x-code>
Fragment::make($fields)
    ->name('fragment-name')
    ->updateAsync(),
</x-code>

<x-p>
    And as an example, let's call an event for successful submission of the form
</x-p>

<x-code>
FormBuilder::make()->async(asyncEvents: 'fragment-updated-fragment-name')
</x-code>

<x-p>
    You can also pass additional parameters with the request via an array
</x-p>

<x-code>
Fragment::make($fields)
    ->name('fragment-name')
    ->updateAsync(['resourceItem' => request('resourceItem')]),
</x-code>

</x-page>
