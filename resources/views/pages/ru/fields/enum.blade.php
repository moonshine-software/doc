<x-page title="Enum поле">

<x-p>
    Работает также как и Select поле но принимает Enum
</x-p>

<x-p>
    Аттрибуту модели необходим EnumCast
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Enum;

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



