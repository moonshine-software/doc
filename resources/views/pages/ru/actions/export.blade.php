<x-page title="Экспорт">

<x-p>
    Экспортирует все данные с учетом фильтрации.
</x-p>

<x-code language="php">
use MoonShine\Actions\ExportAction;

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
            // Если необходимо экспортировать в формате csv
            ->csv()
            // Разделитель для csv
            ->delimiter(',')
        ,
    ];
}
//...
</x-code>

<x-p>
    Экспортируются только те поля, у которых установлен флаг <code>showOnExport</code>
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

<x-image theme="light" src="{{ asset('screenshots/export.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/export_dark.png') }}"></x-image>

</x-page>
