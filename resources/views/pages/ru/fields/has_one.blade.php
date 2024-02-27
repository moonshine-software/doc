<x-page
    title="HasOne"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#fields', 'label' => 'Поля'],
            ['url' => '#parent-id', 'label' => 'ID родителя'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

@include('pages.ru.fields.shared.relation_make', ['field' => 'HasOne', 'label' => 'Profile'])

<x-sub-title id="fields">Поля</x-sub-title>

<x-p>
    Метод <code>fields()</code> позволяет задать какие поля будут участвовать в <em>preview</em> или в построении форм.
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

@include('pages.ru.fields.shared.parent_id')

</x-page>
