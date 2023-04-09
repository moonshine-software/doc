<x-page title="Дата">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Input с типом date и дополнительным методом <code>format</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\Date;

//...
public function fields(): array
{
    return [
        Date::make('Дата создания', 'created_at')
            ->format('d.m.Y') // Формат отображения даты на главной ресурса
    ];
}

//...
</x-code>
    <x-p>
        Для отображения в поле не только даты, но и времени используйте метод <code>withTime</code>
    </x-p>
    <x-code language="php">
        use MoonShine\Fields\Date;

        //...
        public function fields(): array
        {
            return [
                Date::make('Дата и время создания', 'created_at')
                    ->withTime()
            ];
        }

        //...
    </x-code>

</x-page>
