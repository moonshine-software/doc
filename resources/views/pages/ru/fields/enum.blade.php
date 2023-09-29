<x-page title="Enum поле">

<x-extendby :href="route('moonshine.custom_page', 'fields-select')">
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
        Enum::make('Status', 'status_id') // [tl! focus]
            ->attach(EnumStatus::class) // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
