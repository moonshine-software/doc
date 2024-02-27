@php use MoonShine\Fields\Text; @endphp
<x-page
    title="FormBuilder"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#fields', 'label' => 'Поля'],
            ['url' => '#fill', 'label' => 'Значения для полей'],
            ['url' => '#cast', 'label' => 'Приведение к типу'],
            ['url' => '#fillCast', 'label' => 'FillCast'],
            ['url' => '#buttons', 'label' => 'Кнопки'],
            ['url' => '#attributes', 'label' => 'Атрибуты'],
            ['url' => '#name', 'label' => 'Наименование формы'],
            ['url' => '#async', 'label' => 'Асинхронный режим'],
            ['url' => '#precognitive', 'label' => 'Precognitive'],
            ['url' => '#apply', 'label' => 'Apply'],
            ['url' => '#method', 'label' => 'Вызов методов'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Поля и декорации в MoonShine используются внутри форм, за которые отвечает <em>FormBuilder</em>.<br />
    Благодаря <em>FormBuilder</em> происходит отображение и наполнение полей данными.<br />
    Вы также можете использовать <em>FormBuilder</em> на собственных страницах или даже вне <strong>MoonShine</strong>.
</x-p>

<x-code language="php">
make(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
</x-code>

<x-ul>
    <li><code>action</code> - обработчик,</li>
    <li><code>method</code> - тип запроса,</li>
    <li><code>fields</code> - поля и декорации.</li>
    <li><code>values</code> - значения полей.</li>
</x-ul>

<x-code language="php">
FormBuilder::make(
    action:'/crud/update',
    method: 'PUT',
    fields: [
        Text::make('Text')
    ],
    values: ['text' => 'Value']
)
</x-code>

<x-p>
    Тоже самое через методы:
</x-p>

<x-code language="php">
FormBuilder::make()
    ->action('/crud/update')
    ->method('PUT')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
</x-code>

<x-p>
    Также доступен helper:
</x-p>

<x-code language="php">
@{!! form(request()->url(), 'GET')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
!!}
</x-code>

{!!
    form(request()->url(), 'GET')
        ->fields([
            Text::make('Text')
        ])
        ->fill(['text' => 'Value'])
!!}

<x-sub-title id="fields">Поля</x-sub-title>

<x-p>
    Метод <code>fields()</code> используется для объявления полей и декораций формы:
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ]) // [tl! focus:-3]
</x-code>

<x-sub-title id="fill">Значения для полей</x-sub-title>

<x-p>
    Метод <code>fill()</code> используется для наполнения полей значениями:
</x-p>

<x-code language="php">
fill(mixed $values = [])
</x-code>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value']) // [tl! focus]
</x-code>

<x-sub-title id="cast">Приведение к типу</x-sub-title>

<x-p>
    Метод <code>cast()</code> для приведения значений формы к определенному типу.
    Так как по умолчанию поля работают с примитивными типами:
</x-p>

<x-code language="php">
cast(MoonShineDataCast $cast)
</x-code>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->cast(ModelCast::make(User::class)) // [tl! focus]
</x-code>

<x-p>
    В этом примере мы привели данные к формату модели <code>User</code> с использованием <code>ModelCast</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('advanced-type_casts') }}">TypeCasts</x-link>
</x-moonshine::alert>

<x-sub-title id="fillCast">FillCast</x-sub-title>

<x-p>
    Метод <code>fillCast()</code> позволяет привести данные к определенному типу и сразу заполнить значениями:
</x-p>

<x-code language="php">
fillCast(mixed $values, MoonShineDataCast $cast)
</x-code>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        ['text' => 'value'],
        ModelCast::make(User::class)
    ) // [tl! focus:-3]
</x-code>

<x-p>или</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        User::query()->first(),
        ModelCast::make(User::class)
    ) // [tl! focus:-3]
</x-code>

<x-sub-title id="buttons">Кнопки</x-sub-title>

<x-p>
    Кнопки формы можно изменять и добавлять.
</x-p>

<x-p>
    Для кастомизации <strong>"submit"</strong> кнопки, воспользуйтесь методом <code>submit()</code>.
</x-p>

<x-code language="php">
submit(string $label, array $attributes = [])
</x-code>

<x-ul>
    <li><code>label</code> - название кнопки,</li>
    <li><code>attributes</code> - дополнительные атрибуты.</li>
</x-ul>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->submit(label: 'Click me', attributes: ['class' => 'btn-primary']) // [tl! focus]
</x-code>

<x-p>
    Для добавления новых кнопок на основе <code>ActionButton</code>, воспользуйтесь методом <code>buttons()</code>.
</x-p>

<x-code language="php">
buttons(array $buttons = [])
</x-code>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->buttons([
        ActionButton::make('Delete', route('name.delete'))
    ]) // [tl! focus:-2]
</x-code>

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Вы можете задать любые html атрибуты для формы через метод <code>customAttributes()</code>.
</x-p>

<x-code>
FormBuilder::make()
    ->customAttributes(['class' => 'custom-form']) // [tl! focus]
</x-code>

<x-sub-title id="name">Наименование формы</x-sub-title>

<x-p>
    Метод <code>name()</code> позволяет задать уникальное имя для формы, через которое можно будет вызывать события.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->name('main-form') // [tl! focus]
</x-code>

<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Если необходимо отправлять форму асинхронно, то воспользуйтесь методом <code>async()</code>.
</x-p>

<x-code language="php">
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
</x-code>

<x-ul>
    <li><code>asyncUrl</code> - url запроса (по умолчанию запрос отправляется по url action),</li>
    <li><code>asyncEvents</code> - вызываемые события после успешного запроса,</li>
    <li><code>asyncCallback</code> - js callback функция после получения ответа.</li>
</x-ul>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->async() // [tl! focus]
</x-code>

<x-p>
    После успешного запроса, можно вызвать события, добавив параметр <code>asyncEvents</code>.
</x-p>

<x-code language="php">
    FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form']) // [tl! focus]
</x-code>

<x-p>
    В <strong>MoonShine</strong> уже есть набор готовых событий:
</x-p>

<x-ul>
    <li><code>table-updated-{name}</code> - обновление асинхронной таблицы по ее имени,</li>
    <li><code>form-reset-{name}</code> - сброс значений формы по ее имени,</li>
    <li><code>fragment-updated-{name}</code> - обновление blade fragment по его имени.</li>
</x-ul>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Рецепт:
    <x-link link="{{ to_page('recipes') }}#form-with-events">
        Форма при успешном запросе обновляет таблицу и сбрасывает значения
    </x-link>.
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Метод <code>async()</code> должен быть после метода <code>name()</code>!
</x-moonshine::alert>

<x-sub-title id="precognitive">Precognitive</x-sub-title>

<x-p>
    Если необходимо предварительно выполнить <em>precognition</em> валидацию, необходим метод <code>precognitive()</code>.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive() // [tl! focus]
</x-code>

<x-sub-title id="apply">Apply</x-sub-title>

<x-p>
    Метод <code>apply()</code> в <em>FormBuilder</em> проходит по всем полям формы и вызывает их apply методы.
</x-p>

<x-code language="php">
apply(
    Closure $apply,
    ?Closure $default = null,
    ?Closure $before = null,
    ?Closure $after = null,
    bool $throw = false,
)
</x-code>

<x-ul>
    <li><code>$apply</code> - callback функция,</li>
    <li><code>$default</code> - apply для поля по умолчанию,</li>
    <li><code>$before</code> - callback функция до apply,</li>
    <li><code>$after</code> - callback функция после apply,</li>
    <li><code>$throw</code> - вызывать исключения.</li>
</x-ul>

<x-moonshine::divider label="Примеры" />

<x-p>
    Необходимо в контроллере сохранить данные всех полей <em>FormBuilder</em>:
</x-p>

<x-code language="php">
$form->apply(fn(Model $item) => $item->save());
</x-code>

<x-p>
    Более сложный вариант, с указанием событий до сохранения и после:
</x-p>

<x-code language="php">
$form->apply(
    static fn(Model $item) => $item->save(),
    before: function (Model $item) {
        if (! $item->exists) {
            $item = $this->beforeCreating($item);
        }

        if ($item->exists) {
            $item = $this->beforeUpdating($item);
        }

        return $item;
    },
    after: function (Model $item) {
        $wasRecentlyCreated = $item->wasRecentlyCreated;

        $item->save();

        if ($wasRecentlyCreated) {
            $item = $this->afterCreated($item);
        }

        if (! $wasRecentlyCreated) {
            $item = $this->afterUpdated($item);
        }

        return $item;
    },
    throw: true
);
</x-code>

<x-sub-title id="method">Вызов методов</x-sub-title>

<x-p>
    <code>asyncMethod()</code> позволяют указать название метода в ресурсе и асинхронно вызывать при отправке
    <em>FormBuilder</em> без необходимости создавать дополнительные контроллеры.
</x-p>

<x-code language="php">
public function components(): array
{
    return [
        FormBuilder::make()
            ->asyncMethod('updateSomething'), // [tl! focus]
    ];
}
</x-code>

<x-code language="php">
// With toast
public function updateSomething(MoonShineRequest $request)
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    MoonShineUI::toast('MyMessage', 'success');

    return back();
}

// Exception
public function updateSomething(MoonShineRequest $request)
{
    throw new \Exception('My message');
}

// Custom json response
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->toast('MyMessage', ToastType::SUCCESS);
}
</x-code>

</x-page>
