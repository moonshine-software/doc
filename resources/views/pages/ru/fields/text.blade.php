<x-page title="Текстовое поле" :sectionMenu="[
    'Разделы' => [
        ['url' => '#mask', 'label' => 'Маска'],
        ['url' => '#extensions', 'label' => 'Расширения'],
    ]
]">

<x-p>
    Текстовое поле включает в себя все базовые методы
</x-p>

<x-code language="php">
use MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')  // [tl! focus]
    ];
}

//...
</x-code>


<x-sub-title id="mask">Маска</x-sub-title>

<x-p>
    Метод <code>mask</code> если необходимо добавить маску для поля
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->mask('7 (999) 999-99-99') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="extensions">Расширения</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
return [
    Text::make('Title', 'title')
        // Возможность скопировать значение по кнопке
        ->copy()
        // Замок с блокировкой изменений
        ->lock()
        // Подсказка формата
        ->expansion('kg')
        // Отключение отображения значения
        ->eye()
    ];
}

//...
</x-code>

</x-page>
