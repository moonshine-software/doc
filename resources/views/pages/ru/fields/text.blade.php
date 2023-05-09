<x-page
    title="Текстовое поле"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#mask', 'label' => 'Маска'],
            ['url' => '#extensions', 'label' => 'Расширения'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=0&end=56', 'title' => 'Screencasts: Поле Text'],
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=978&end=1159', 'title' => 'Screencasts: Расширение поля'],
    ]"
>

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

<x-image theme="light" src="{{ asset('screenshots/input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/input_dark.png') }}"></x-image>

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

<x-image theme="light" src="{{ asset('screenshots/mask.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/mask_dark.png') }}"></x-image>

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
            ->locked()
            // Подсказка формата
            ->expansion('kg')
            // Отключение отображения значения
            ->eye()
        ];
    }

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/expansion.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/expansion_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Метод <code>copy</code> использует <code>Clipboard API</code> который доступен только для HTTPS или localhost
</x-moonshine::alert>

</x-page>
