<x-page
    title="Enum"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#preview', 'label' => 'Preview'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-extendby :href="route('moonshine.page', 'fields-select')">
    Select
</x-extendby>

<x-p>
    Работает так же как и поле <em>Select</em>, но в качестве options принимает <em>Enum</em>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Аттрибуту модели необходим EnumCast.
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

<x-sub-title id="preview">Preview</x-sub-title>

<x-p>
    Если в <em>Enum</em> реализован метод <code>getColor()</code>,
    то в <em>preview</em> поле отобразиться в виде значка определенного цвета.
</x-p>

@include('pages.ru.components.shared.colors')

<x-code language="php">
namespace App\Enums;

enum StatusEmun: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case PUBLIC = 'public';

    public function getColor(): string
    {
        return match ($this) {
            StatusEmun::NEW => 'info',
            StatusEmun::DRAFT => 'gray',
            StatusEmun::PUBLIC => 'success',
        };
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/enum.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/enum_dark.png') }}"></x-image>

</x-page>
