<x-page
    title="Text field"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#default', 'label' => 'Default value'],
            ['url' => '#readonly', 'label' => 'Only for reading'],
            ['url' => '#mask', 'label' => 'Mask'],
            ['url' => '#placeholder', 'label' => 'Placeholder'],
            ['url' => '#extensions', 'label' => 'Extensions'],
            ['url' => '#update-on-preview', 'label' => 'Editing in preview'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The text field includes all the basic methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Title')  // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/input_dark.png') }}"></x-image>

<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    You can use the <code>default()</code> method if you need to specify a default value for a field.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->default('-') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="readonly">Only for reading</x-sub-title>

<x-p>
    If the field is read-only, then you must use the <code>readonly()</code> method.
</x-p>

<x-code language="php">
readonly(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->readonly() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="mask">Mask</x-sub-title>

<x-p>
    The <code>mask()</code> method is used to add a mask to a field.
</x-p>

<x-code language="php">
mask(string $mask)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->mask('7 (999) 999-99-99') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/mask.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/mask_dark.png') }}"></x-image>

@include('pages.ru.fields.shared.placeholder', ['field' => 'Text'])

<x-sub-title id="extensions">Extensions</x-sub-title>

<x-p>There are several extensions available for the <em>Text</em> field:</x-p>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> ability to copy a value using a button</x-p>

<x-code language="php">
copy()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> lock with change blocking</x-p>

<x-code language="php">
locked()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> disable value display</x-p>

<x-code language="php">
eye()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> format hint</x-p>

<x-code language="php">
expansion(string $ext)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy() // [tl! focus]
            ->locked() // [tl! focus]
            ->expansion('kg') // [tl! focus]
            ->eye() // [tl! focus]
        ];
    }

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/expansion.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/expansion_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <code>copy</code> method uses the <code>Clipboard API</code> which is only available for HTTPS or localhost
</x-moonshine::alert>

<x-p>
    You can use custom extensions,
    To do this, they must be added to the field via the <code>extension()</code> method.
</x-p>

<x-code language="php">
extension(InputExtension $extension)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->extension(new InputCustomExtension()) // [tl! focus]
        ];
    }

//...
</x-code>

@include('pages.ru.fields.shared.update_on_preview', ['field' => 'Text'])

</x-page>
