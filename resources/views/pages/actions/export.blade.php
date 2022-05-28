<x-page title="Экспорт">

<x-p>
    Экспортирует все данные с учетом фильтрации в csv файл
</x-p>

<x-code language="php">
use Leeto\MoonShine\Actions\Export;

//...
public function actions(): array
{
    return [
        Export::make('Экспорт'),
    ];
}
//...
</x-code>

<x-p>
    Экспортируются только те поля у которых установлен флаг для отображения в экспорте
</x-p>

<x-code language="php">
use Leeto\MoonShine\Actions\Export;

//...
public function fields(): array
{
    return [
        ID::make()->showOnExport(),
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/export.png') }}"></x-image>

<x-next href="{{ route('section', 'authorization-index') }}">Авторизация</x-next>
</x-page>