<x-page title="Title">

<x-p>
    You can add headers to separate areas of the form
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Heading;

//...
public function fields(): array
{
    return [
        Heading::make('Contact info'),

        Text::make('Surname', 'last_name'),
        Text::make('Name', 'first_name'),
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/heading.png') }}"></x-image>

</x-page>
