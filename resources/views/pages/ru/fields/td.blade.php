<x-page
    title="Td"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#fields', 'label' => 'Поля'],
            ['url' => '#labels', 'label' => 'Подписи полей'],
            ['url' => '#attributes', 'label' => 'Атрибуты'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Поле <em>Td</em> предназначено для модификации отображения ячейки таблицы в режиме <code>preview</code>.
</x-p>

<x-code language="php">
make(Closure|string $label, ?Closure $fields = null)
</x-code>

<x-ul>
    <li><code>$label</code> - название колонки,</li>
    <li><code>$fields</code> - замыкание возвращающее массив полей.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Td; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', fn () => [
            Text::make('Title'),
        ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Поле <em>Td</em> не отображается в формах, оно предназначено только для режима <code>preview</code>!
</x-moonshine::alert>

<x-p>
    Замыкание может принимать в качестве параметра текущий элемент.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Flex;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Td; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', function (Article $v) { // [tl! focus:start]
            if($v->active) {
                return [
                    Text::make('Title'),
                ];
            }

            return [
                Flex::make([
                    ActionButton::make('Click me', $this->detailPageUrl($v)),
                    Text::make('Title'),
                    Switcher::make('Active'),
                ])
            ];
        }), // [tl! focus:end]
    ];
}

//...
</x-code>

<x-sub-title id="fields">Поля</x-sub-title>

<x-p>
    Указать какие поля будут отображаться в ячейке можно также через метод <code>fields()</code>.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column')
            ->fields([
                Text::make('Title')
            ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="labels">Подписи полей</x-sub-title>

<x-p>
    Метод <code>withLabels()</code> позволяет отобразить <em>Label</em> у полей в ячейке.
</x-p>

<x-code language="php">
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', fn () => [
            Text::make('Title'),
        ])
            ->withLabels(), // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Полю <em>Td</em> можно задать дополнительные атрибуты через метод <code>tdAttributes()</code>.
</x-p>

<x-code language="php">
/**
 * @param  Closure(mixed $data, ComponentAttributeBag $attributes, $td self): ComponentAttributeBag  $attributes
 */
tdAttributes(Closure $attributes)
</x-code>

<x-code language="php">
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column')
            ->fields([
                Text::make('Title')
            ])
            ->tdAttributes(fn (Article $data, ComponentAttributeBag $attr) => $data->getKey() === 2 ? $attr->merge([
                'style' => 'background: lightgray'
            ]) : $attr),  // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
