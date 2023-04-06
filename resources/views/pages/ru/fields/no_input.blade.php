<x-page title="NoInput" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basic', 'label' => 'Базовое использование'],
        ['url' => '#badge', 'label' => 'Badge'],
        ['url' => '#boolean', 'label' => 'Boolean'],
    ]
]">

<x-p>
    <b>Поле не предназначено для ввода/изменения данных!</b>
</x-p>

<x-sub-title id="basic">Базовое использование</x-sub-title>

<x-p>
    С помощью данного поля по умолчанию вы можете вывести текстовые данные из любого поля модели,
    либо сгенерировать текст на основе модели.
</x-p>

<x-code language="php">
//...
use Leeto\MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('No input field', 'no_input', static fn() => fake()->realText()),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/no-input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/no-input_dark.png') }}"></x-image>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    Отображение в виде ярлыка, как пример подойдет для статуса заказа!
    Используем метод badge с параметром цвета,
    который может быть как строкой так и замыканием с текущим элементом в параметре
</x-p>

<x-code language="php">
//...
use Leeto\MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('Status')->badge(fn($item) => $item->status_id === 1 ? 'green' : 'gray'),
    ];
}

//...
</x-code>

<x-sub-title id="boolean">Boolean</x-sub-title>

<x-p>
    Отображение в виде метки (зеленой либо красной) для boolean значений.
    Параметры hideTrue и hideFalse позволяют скрыть метку для значений
</x-p>

<x-code language="php">
//...
use Leeto\MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('Active')->boolean(hideTrue: false, hideFalse: false),
    ];
}

//...
</x-code>

</x-page>
