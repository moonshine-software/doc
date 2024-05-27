<x-page
    title="Декоратор Fragment"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#async', 'label' => 'Асинхронное событие'],
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

<x-sub-title id="async">Асинхронное событие</x-sub-title>

<x-p>
    Вы можете обвернуть область в Fragment и повесить на эту область событие,
    вызвав которое можно будет обновить фрагмент
</x-p>

<x-code>
Fragment::make($fields)
    ->name('fragment-name'),
</x-code>

<x-p>
    И как пример вызовем событие на успешную отправку формы
</x-p>

<x-code>
FormBuilder::make()->async(asyncEvents: 'fragment-updated-fragment-name')
</x-code>

<x-p>
    Также с запросом можно передать дополнительные параметры через массив
</x-p>

<x-code>
Fragment::make($fields)
    ->name('fragment-name')
    ->updateAsync(['resourceItem' => request('resourceItem')]),
</x-code>

<x-moonshine::divider label="Значения полей" />

<x-p>
    Метод <code>withParams()</code> позволяет передать с запросом значения полей, используя селекторы элементов.
</x-p>

<x-code language="php">
Fragment::make($fields)
    ->withParams([
        'start_date' => '#start_date',
        'end_date' => '#end_date'
    ]) // [tl! focus:-3]
    ->name('fragment-name'),
</x-code>

</x-page>
