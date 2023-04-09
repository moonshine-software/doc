<x-page title="Импорт">

<x-p>
    Импортирует данные
</x-p>

<x-code language="php">
use MoonShine\Actions\ImportAction;

//...
public function actions(): array
{
    return [
        ImportAction::make('Импорт')
            // Опциональные методы
            // Если необходимо запускать в фоне
            ->queue()
            // Выбор диска
            ->disk('public')
            // Выбор директории сохранения
            ->dir('/exports')
            // Удалять после импорта
            ->deleteAfter()
        ,
    ];
}
//...
</x-code>

<x-p>
    Импортироваться будут только те поля, которые помечены с помощью метода <code>useOnImport</code>
</x-p>

<x-code language="php">

//...
public function fields(): array
{
    return [
        // Обязательно помечайте идентификатор иначе все записи будут добавляться а не редактироваться
        ID::make()
            ->useOnImport(),

        Text::make('Title')
            ->useOnImport(),
    ];
}
//...
</x-code>

</x-page>
