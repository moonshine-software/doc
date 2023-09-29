<x-page title="Enum field">

<x-extendby :href="route('moonshine.page', 'fields-select')">
    Select
</x-extendby>

<x-p>
    Works the same as the Select field but accepts Enum
</x-p>

<x-p>
    Model attribute requires EnumCast
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
