<x-page title="Title">

<x-p>
    You can add headers to separate areas of the form
</x-p>

<x-code language="php">
use MoonShine\Decorations\Heading;

//...
public function fields(): array
{
    return [
        Heading::make('Title/Slug'),

        Text::make('Title')
            ->fieldContainer(false),
        Text::make('Slug')
            ->fieldContainer(false),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/heading.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/heading_dark.png') }}"></x-image>

</x-page>
