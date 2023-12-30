<x-page title="Telephone">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Phone</em> field is an extension of <em>Text</em>,
    which by default sets <code>type=tel</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Phone; // [tl! focus]

//...

public function fields(): array
{
    return [
        Phone::make('Phone') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    To use a mask for the phone, use the <code>mask('7 999 999-99-99')</code> method
</x-moonshine::alert>

</x-page>
