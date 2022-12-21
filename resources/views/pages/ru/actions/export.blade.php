<x-page title="Экспорт">

<x-p>
    Экспортирует все данные с учетом фильтрации
</x-p>

<x-code language="php">
use Leeto\MoonShine\Actions\ExportAction;

//...
public function actions(): array
{
    return [
        ExportAction::make('Экспорт')
            // Опциональные методы
            // Если необходимо запускать в фоне
            ->queue()
            // Выбор диска
            ->disk('public')
            // Выбор директории сохранения
            ->dir('/exports')
        ,
    ];
}
//...
</x-code>

<x-p>
    Экспортируются только те поля, у которых установлен флаг для отображения в экспорте
</x-p>

<x-code language="php">

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

</x-page>
