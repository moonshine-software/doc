<x-page
    title="Enum"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#value', 'label' => 'Displaying values'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-extendby :href="to_page('fields-select')">
    Select
</x-extendby>

<x-p>
    Works the same as the <em>Select</em> field, but takes an <em>Enum</em> as options.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Model attributes require Enum Cast.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Enum; // [tl! focus]

//...

public function fields(): array
{
    return [
        Enum::make('Status') // [tl! focus]
            ->attach(StatusEnum::class) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="value">Displaying values</x-sub-title>

<x-moonshine::divider label="toString" />

<x-p>
    The <code>toString()</code> method implemented in <em>Enum</em>
    allows you to set the output value.
</x-p>

<x-code language="php">
namespace App\Enums;

enum StatusEmun: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case PUBLIC = 'public';

    public function toString(): ?string
    {
        return match ($this) {
            self::NEW => 'New',
            self::DRAFT => 'Draft',
            self::PUBLIC => 'Public',
        };
    }
}
</x-code>

<x-moonshine::divider label="getColor" />

<x-p>
    If <em>Enum</em> implements the <code>getColor()</code> method,
    then the <em>preview</em> field will appear as an icon of a certain color.
</x-p>

@include('pages.en.ui.shared.colors')

<x-code language="php">
namespace App\Enums;

enum StatusEmun: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case PUBLIC = 'public';

    public function getColor(): ?string
    {
        return match ($this) {
            self::NEW => 'info',
            self::DRAFT => 'gray',
            self::PUBLIC => 'success',
        };
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/enum.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/enum_dark.png') }}"></x-image>

</x-page>
