<x-sub-title id="with-image">Values with picture</x-sub-title>

<x-p>
    The <code>withImage()</code> method allows you to add an image to a value.
</x-p>

<x-code language="php">
withImage(
    string $column,
    string $disk = 'public',
    string $dir = ''
)
</x-code>

<x-ul>
    <li><code>$column</code> - field with an image;</li>
    <li><code>$disk</code> - file system disk;</li>
    <li><code>$dir</code> - directory relative to the root of the disk.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make({!! $field === 'BelongsToMany' ? 'Countries' : 'Country' !!}, resource: new CountryResource())
            ->withImage('thumb', 'public', 'countries'){!! $field === 'BelongsToMany' ? '->selectMode()' : '' !!} // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_image.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_image_dark.png') }}"></x-image>
