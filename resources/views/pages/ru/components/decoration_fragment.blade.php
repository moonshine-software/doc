<x-page
    title="Декоратор Fragment"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Иногда может потребоваться вернуть только часть шаблона в вашем HTTP ответе. Для это можно воспользоваться
    <x-link link="https://laravel.com/docs/blade#rendering-blade-fragments" target="_blank">Blade Fragments</x-link>.<br />
    Декоратор <em>Fragment</em> позволяет создавать соответствующие блоки.
</x-p>

<x-p>
    Создать <em>Fragment</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(array $fields = [])
</x-code>

<x-p>
    Метод <code>name()</code> задает название для фрагмента.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Fragment; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Fragment::make([ // [tl! focus]
            Text::make('Name', 'first_name')
        ])
            ->name('fragment-name') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
