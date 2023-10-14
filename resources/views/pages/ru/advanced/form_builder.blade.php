@php use MoonShine\Fields\Text; @endphp
<x-page
    title="FormBuilder"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#methods', 'label' => 'Методы'],
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
    Так как по умолчанию форма работает с массивом:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value'])
    ->cast(ModelCast::make(User::class))
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

<x-moonshine::divider label="async/precognition" />

<x-p>
    Если необходимо отправлять форму асинхронно, то воспользуйтесь методом <code>async</code>.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->async()
</x-code>

<x-p>
    Если необходимо предварительно выполнить precognition валидацию, необходим метод <code>precognitive</code>.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive()
</x-code>

<x-moonshine::divider label="Attributes" />

<x-p>
    Вы можете задать любые html атрибуты для формы через метод <code>customAttributes</code>.
</x-p>

<x-code>
FormBuilder::make()->customAttributes(['class' => 'custom-form']),
</x-code>
</x-page>
