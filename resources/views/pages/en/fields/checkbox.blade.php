<x-page
    title="Checkbox"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#on-off', 'label' => 'On/off values'],
            ['url' => '#update-on-preview', 'label' => 'Editing in preview'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Checkbox</em> field includes all the basic methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Checkbox; // [tl! focus]

//...

public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="on-off">On/off values</x-sub-title>

<x-p>
    By default, the field has the values <code>1</code> and <code>0</code> for the selected and unselected states, respectively.
    The <code>onValue()</code> and <code>offValue()</code> methods allow you to override these values.
</x-p>

<x-code language="php">
onValue(int|string $onValue)
</x-code>

<x-code language="php">
offValue(int|string $onValue)
</x-code>

<x-code language="php">
use MoonShine\Fields\Checkbox;

//...

public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish')
            ->onValue('yes')// [tl! focus]
            ->offValue('no')// [tl! focus]
    ];
}

//...
</x-code>

@include('pages.en.fields.shared.update_on_preview', ['field' => 'Checkbox'])

</x-page>
