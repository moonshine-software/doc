<x-page title="Основы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#make', 'label' => 'Make'],
        ['url' => '#hide-show', 'label' => 'Отображение'],
        ['url' => '#attributes', 'label' => 'Аттрибуты'],
        ['url' => '#autocomplete', 'label' => 'Autocomplete'],
        ['url' => '#required', 'label' => 'Обязательное поле'],
        ['url' => '#hint', 'label' => 'Подсказка'],
        ['url' => '#link', 'label' => 'Ссылка'],

        ['url' => '#sortable', 'label' => 'Сортировка'],
        ['url' => '#mask', 'label' => 'Маска'],
        ['url' => '#default', 'label' => 'Значение по умолчанию'],
        ['url' => '#show-when', 'label' => 'Условие отображения'],
    ]
]">

<x-p>
    Поля один из важнейших разделов вместе с ресурсами.
    В разделе ресурсы мы уже рассмотрели как регистрировать поля, а сейчас разберемся как их настраивать
    под свои нужды! Для удобства используется fluent интерфейс
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Для начала разберемся в методе <code>make</code> при создании экземпляра поля
</x-p>

<x-code language="php">
Text::make(string $label = null, string $field = null, ResourceContract|string|null $resource = null)
</x-code>

<x-p>
    $label - Лейбл, заголовок поля<br>
    $field - Поле в базе (например name) или отношение (например countries)<br>
    $resource - В случае если $field отношение в этом параметре необходимо указать поле
    в связанной таблице которое будет отображаться во view
</x-p>

<x-alert>
    $resource также может быть Resource классом в котором если будет указано свойство
    <code>$titleField</code>, то поле у отношения будет определено через него
</x-alert>

<x-code language="php">
//...
class MoonShineUserResource extends BaseResource
{
public static string $model = MoonshineUser::class;

public static string $title = 'Администраторы';

public string $titleField = 'name'; // [tl! focus]
//...
</x-code>

<x-sub-title id="hide-show">Отображение</x-sub-title>

<x-p>
    Поля отображаются на странице со списком (главная страница ресурса) и страница создания/редактирования.
    Чтобы исключить вывод поля на главной либо на странице с формой, можно воспользоваться методами
    <code>hideOnIndex/hideOnForm</code>, обратные методы <code>showOnIndex/showOnForm</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        ID::make(),
        Text::make('Заголовок', 'title')
        // [tl! focus:start]
            ->hideOnIndex()
            ->hideOnForm()
        // [tl! focus:end]
        ,
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Аттрибуты</x-sub-title>

<x-p>
    Так как на форме рендерится html элемент, то также есть возможность управлять базовыми html аттрибутами.
    Такими как <code>disabled</code>, <code>autocomplete</code>, <code>readonly</code>, <code>multiple</code> и тд.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->disabled() // [tl! focus]
            ->hidden() // [tl! focus]
            ->readonly(), // [tl! focus]
        ];
    }

//...
</x-code>

<x-sub-title id="autocomplete">Autocomplete</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Пароль', 'password')
            ->autocomplete('off') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="required">Обязательное поле</x-sub-title>

<x-p>
    Чтобы сделать поле обязательным к заполнению, необходимо воспользоватсья методом <code>required</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->required() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="hint">Подсказка</x-sub-title>

<x-p>
    Полю можно добавить подсказку с описанием вызвав метод <code>hint</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->hint('Подсказка для поля заголовок') // [tl! focus]
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/hint.png') }}"></x-image>

<x-sub-title id="link">Ссылка</x-sub-title>

<x-p>
    Полю можно добавить ссылку (например с инструкциями) <code>addLink(string $name, string $link)</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->addLink('YouTube', 'https://youtube.com') // [tl! focus]
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/link.png') }}"></x-image>

<x-sub-title id="sortable">Сортировка</x-sub-title>

<x-p>
    Для возможности сортировки поля на главной странице ресурса необходимо добавить метод <code>sortable</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->sortable() // [tl! focus]
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

<x-sub-title id="default">Значение по умолчанию</x-sub-title>

<x-p>
    Метод <code>default</code> если необходимо указать значение по умолчанию для поля
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->default('-') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="show-when">Условие отображения</x-sub-title>

<x-p>
    Может возникнуть потребность отображать поле только в том случае, если значение у
    другого поля в форме имеет определенное значение (Скажем отображать телефон, только если
    стоит галочка что телефон есть). Метод <code>showWhen(string $field_name, string $item_value)</code>
</x-p>


<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')
            ->showWhen('has_phone', 1) // [tl! focus]
    ];
}

//...
</x-code>

<x-next href="{{ route('section', 'fields-id') }}">ID</x-next>

</x-page>



