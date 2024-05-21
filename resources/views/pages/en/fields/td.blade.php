<x-page
    title="Td"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#fields', 'label' => 'Fields'],
            ['url' => '#labels', 'label' => 'Labels'],
            ['url' => '#attributes', 'label' => 'Attributes'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Td</em> field is intended to modify the display of a table cell in the <code>preview</code> mode.
</x-p>

<x-code language="php">
make(Closure|string $label, ?Closure $fields = null)
</x-code>

<x-ul>
    <li><code>$label</code> - column name</li>
    <li><code>$fields</code> - a closure that returns an array of fields.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Td; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', fn () => [
            Text::make('Title'),
        ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The <em>Td</em> field is not displayed in forms, it is intended only for <code>preview</code> mode!
</x-moonshine::alert>

<x-p>
    A closure can take the current element as a parameter.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Flex;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Td; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', function (Article $v) { // [tl! focus:start]
            if($v->active) {
                return [
                    Text::make('Title'),
                ];
            }

            return [
                Flex::make([
                    ActionButton::make('Click me', $this->detailPageUrl($v)),
                    Text::make('Title'),
                    Switcher::make('Active'),
                ])
            ];
        }), // [tl! focus:end]
    ];
}

//...
</x-code>

<x-sub-title id="fields">Fields</x-sub-title>

<x-p>
    You can also specify which fields will be displayed in a cell using the <code>fields()</code> method.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column')
            ->fields([
                Text::make('Title')
            ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="labels">Labels</x-sub-title>

<x-p>
    The <code>withLabels()</code> method allows you to display a <em>Label</em> for fields in a cell.
</x-p>

<x-code language="php">
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', fn () => [
            Text::make('Title'),
        ])
            ->withLabels(), // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    The <em>Td</em> field can be given additional attributes using the <code>tdAttributes()</code> method.
</x-p>

<x-code language="php">
/**
 * @param  Closure(mixed $data, ComponentAttributeBag $attributes, $td self): ComponentAttributeBag  $attributes
 */
tdAttributes(Closure $attributes)
</x-code>

<x-code language="php">
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column')
            ->fields([
                Text::make('Title')
            ])
            ->tdAttributes(fn (Article $data, ComponentAttributeBag $attr) => $data->getKey() === 2 ? $attr->merge([
                'style' => 'background: lightgray'
            ]) : $attr),  // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
