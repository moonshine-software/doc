<x-page
    title="Code"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#language', 'label' => 'Language'],
            ['url' => '#line-numbers', 'label' => 'Line numbering'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-textarea')">
    Textarea
</x-extendby>

<x-p>
    The <em>Code</em> field is an extension of <em>Textarea</em> with a visual appearance of the edited code.
</x-p>

<x-code language="php">
use MoonShine\Fields\Code; // [tl! focus]

//...

public function fields(): array
{
    return [
        Code::make('Code') // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/code.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/code_dark.png') }}"></x-image>

<x-sub-title id="language">Language</x-sub-title>

<x-p>
    By default, PHP styling is used, but using the <code>language()</code> method
    You can change the design for another programming language.
</x-p>

<x-code language="php">
language(string $language)
</x-code>

<x-p>
    Supported languages:
    <x-moonshine::badge color="gray">HTML</x-moonshine::badge>,
    <x-moonshine::badge color="gray">XML</x-moonshine::badge>,
    <x-moonshine::badge color="gray">CSS</x-moonshine::badge>,
    <x-moonshine::badge color="gray">PHP</x-moonshine::badge>,
    <x-moonshine::badge color="gray">JavaScript</x-moonshine::badge>
    and many others.
</x-p>

<x-code language="php">
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->language('js') // [tl! focus]
    ];
}
//...
</x-code>

<x-sub-title id="line-numbers">Line numbering</x-sub-title>

<x-p>
    The <code>lineNumbers()</code> method allows you to display line numbering.
</x-p>

<x-code language="php">
lineNumbers()
</x-code>

<x-code language="php">
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->lineNumbers() // [tl! focus]
    ];
}
//...
</x-code>

</x-page>
