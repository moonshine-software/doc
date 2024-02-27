<x-page
    title="HasOne"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#fields', 'label' => 'Fields'],
            ['url' => '#parent-id', 'label' => 'Parent ID'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

@include('pages.en.fields.shared.relation_make', ['field' => 'HasOne', 'label' => 'Profile'])

<x-sub-title id="fields">Fields</x-sub-title>

<x-p>
    The <code>fields()</code> method allows you to specify which fields will participate in <em>preview</em> or in building forms.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        HasOne::make('Contacts', resource: new ContactResource())
            ->fields([
                Phone::make('Phone'),
                Text::make('Address'),
            ]) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_one_preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_preview_dark.png') }}"></x-image>

@include('pages.en.fields.shared.parent_id')

</x-page>
