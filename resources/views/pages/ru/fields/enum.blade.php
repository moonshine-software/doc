<x-page title="Enum поле">

<x-extendby :href="route('moonshine.custom_page', 'fields-select')">
    Select
</x-extendby>

<x-p>
    Работает так же как и Select поле но принимает Enum
</x-p>

<x-p>
    Аттрибуту модели необходим EnumCast
</x-p>

<x-code language="php">
use MoonShine\Fields\Enum;

//...

public function fields(): array
{
    return [
        Enum::make('Status', 'status_id')->attach(EnumStatus::class)
    ];
}

//...
</x-code>

</x-page>
