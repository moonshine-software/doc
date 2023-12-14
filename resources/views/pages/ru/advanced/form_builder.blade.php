@php use MoonShine\Fields\Text; @endphp
<x-page
    title="FormBuilder"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#methods', 'label' => 'Методы'],
            ['url' => '#async', 'label' => 'Асинхронный режим'],
            ['url' => '#apply', 'label' => 'Apply'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Поля и декорации в MoonShine используются внутри форм, за которые отвечает FormBuilder.
    Благодаря FormBuilder происходит отображение и наполнение полей данными.
    Вы также можете использовать FormBuilder на собственных страницах или даже вне MoonShine.
</x-p>

<x-code language="php">
make(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
</x-code>

<ul>
    <li><code>action</code> - обработчик,</li>
    <li><code>method</code> - тип запроса,</li>
    <li><code>fields</code> - поля и декорации.</li>
    <li><code>values </code> - значения полей.</li>
</ul>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
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


<x-sub-title id="methods">Методы</x-sub-title>

<x-moonshine::divider label="fields" />

<x-p>
    Метод <code>fields</code> для объявления полей и декораций формы:
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
</x-code>

<x-moonshine::divider label="fill" />

<x-p>
    Метод <code>fill</code> для наполнения полей значениями:
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value'])
</x-code>

<x-moonshine::divider label="cast" />

<x-p>
    Метод <code>cast</code> для приведения значений формы к определенному типу.
    Так как по умолчанию поля работают с примитивными типами:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(['text' => 'value'], ModelCast::make(User::class))
</x-code>

<x-code language="php">
    use MoonShine\TypeCasts\ModelCast;

    FormBuilder::make('/crud/update', 'PUT')
    ->fields([
    Heading::make('Title'),
    Text::make('Text'),
    ])
    ->fillCast(User::query()->first(), ModelCast::make(User::class))
</x-code>

<x-p>
    В этом примере мы привели данные к формату модели <code>User</code> с использованием <code>ModelCast</code>.
</x-p>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Подробнее о TypeCasts читайте в одноименном разделе
    </x-moonshine::alert>
</x-p>

<x-moonshine::divider label="buttons" />

<x-p>
    Кнопки формы можно изменять и добавлять.
</x-p>

<x-p>
    Для кастомизации "submit" кнопки, воспользуйтесь методом <code>submit</code>
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->submit(label: 'Click me', attributes: ['class' => 'btn-primary'])
</x-code>

<x-p>
    Для добавления новых кнопок на основе <code>ActionButton</code>, воспользуйтесь методом <code>buttons</code>
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->buttons([
        ActionButton::make('Delete', route('name.delete'))
    ])
</x-code>

<x-moonshine::divider label="Attributes" />

<x-p>
    Вы можете задать любые html атрибуты для формы через метод <code>customAttributes</code>.
</x-p>

<x-code>
FormBuilder::make()->customAttributes(['class' => 'custom-form']),
</x-code>

<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Если необходимо отправлять форму асинхронно, то воспользуйтесь методом <code>async</code>.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->async()
</x-code>

<x-p>
    После успешного запроса, можно вызвать события, добавив параметр <code>asyncEvents</code>.
</x-p>

<x-code language="php">
    FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form'])
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.information-circle">
    В MoonShine уже есть набор готовых событий
</x-moonshine::alert>

<ul>
    <li><code>table-updated-{name}</code> - Обновление асинхронной таблицы по ее имени</li>
    <li><code>form-reset-{name}</code> - Сброс значений формы по ее имени</li>
    <li><code>fragment-updated-{name}</code> - Обновление blade fragment по его имени</li>
</ul>

<x-p>
    Если необходимо предварительно выполнить precognition валидацию, необходим метод <code>precognitive</code>.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive()
</x-code>

@include('pages.ru.recipes.form-with-events')

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

<ul>
    <li><code>$apply</code> - callback функция;</li>
    <li><code>$default</code> - apply для поля по умолчанию;</li>
    <li><code>$before</code> - callback функция до apply;</li>
    <li><code>$after</code> - callback функция после apply;</li>
    <li><code>$throw</code> - вызывать исключения.</li>
</ul>

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

</x-page>
