<x-page
    title="Checkbox"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#on-off', 'label' => 'Значения on/off'],
            ['url' => '#update-on-preview', 'label' => 'Редактирование в preview'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Поле <em>Checkbox</em> включает в себя все базовые методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Checkbox; // [tl! focus]

//...

public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="on-off">Значения on/off</x-sub-title>

<x-p>
    По умолчанию поле имеет значения <code>1</code> и <code>0</code> для выбранного и не выбранного состояния соответственно.
    Методы <code>onValue()</code> и <code>offValue()</code> позволяют переопределить эти значения.
</x-p>

<x-code language="php">
onValue(int|string $onValue)
</x-code>

<x-code language="php">
offValue(int|string $onValue)
</x-code>

<x-code language="php">
use MoonShine\Fields\Checkbox;

//...

public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish')
            ->onValue('yes')// [tl! focus]
            ->offValue('no')// [tl! focus]
    ];
}

//...
</x-code>

@include('pages.ru.fields.shared.update_on_preview', ['field' => 'Checkbox'])

</x-page>
