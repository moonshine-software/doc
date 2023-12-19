<x-sub-title id="with-image">Значения с изображением</x-sub-title>

<x-p>
    Метод <code>withImage()</code> позволяет добавить изображение к значению.
</x-p>

<x-code language="php">
withImage(
    string $column,
    string $disk = 'public',
    string $dir = ''
)
</x-code>

<x-ul>
    <li><code>$column</code> - поле с изображением;</li>
    <li><code>$disk</code> - диск файловой системы;</li>
    <li><code>$dir</code> - директория относительно корня диска.</li>
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
