<x-page
    title="Markdown"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#toolbar', 'label' => 'Toolbar'],
            ['url' => '#options', 'label' => 'Options'],
            ['url' => '#global-configuration', 'label' => 'Global configuration'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-textarea')">
    Textarea
</x-extendby>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    <b><em>Markdown</em></b> a lightweight markup language designed to indicate formatting in plain text, while maximizing its human readability.
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

<x-sub-title id="toolbar">Toolbar</x-sub-title>

<x-p>
    The <code>toolbar()</code> method allows you to change the toolbar.
</x-p>

<x-code language="php">
toolbar(string|bool|array $value)
</x-code>

<x-code language="php">
use MoonShine\Fields\Markdown;

//...

Markdown::make('Description')
    ->toolbar(['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule']) // [tl! focus]
</x-code>

<x-sub-title id="options">Options</x-sub-title>

<x-p>
    The <code>addOption()</code> method allows you to add or change options for the markdown editor.
</x-p>

<x-code language="php">
addOption(string $name, string|int|float|bool|array $value)
</x-code>

<x-code language="php">
use MoonShine\Fields\Markdown;

//...

Markdown::make('Description')
    ->addOption('toolbar',  ['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule']) // [tl! focus]
</x-code>

<x-sub-title id="global-configuration">Global configuration</x-sub-title>

<x-p>
    If you need to change settings for the editor globally,
    you can use the static method <code>setDefaultOption()</code>.
</x-p>

<x-code language="php">
setDefaultOption(string $name, string|int|float|bool|array $value)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Fields\Markdown;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Markdown::setDefaultOption('toolbar',  ['bold', 'italic', 'strikethrough', 'code', 'quote']); // [tl! focus]
    }
}
</x-code>

</x-page>
