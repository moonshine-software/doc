<x-page
    title="Markdown"
>

<x-extendby :href="to_page('fields-textarea')">
    Textarea
</x-extendby>

<x-p>
    <b><em>Markdown</em></b> облегчённый язык разметки, созданный с целью обозначения форматирования в простом тексте, с максимальным сохранением его читаемости человеком.
</x-p>

<x-code language="php">
use MoonShine\Fields\Markdown; // [tl! focus]

//...

public function fields(): array
{
    return [
        Markdown::make('Description') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-image theme="light" src="{{ asset('screenshots/markdown.png') }}"></x-image>
        <x-image theme="dark" src="{{ asset('screenshots/markdown_dark.png') }}"></x-image>
    </x-moonshine::column>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-image theme="light" src="{{ asset('screenshots/markdown_preview.png') }}"></x-image>
        <x-image theme="dark" src="{{ asset('screenshots/markdown_preview_dark.png') }}"></x-image>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
