<x-p>
    Поле <em>{{ $field }}</em> предназначено для работы с одноименным отношением в Laravel
    и включает в себя все базовые методы.
</x-p>

<x-p>
    Для создания данного поля используется статический метод <code>make()</code>.
</x-p>

<x-code language="php">
{{ $field }}::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
</x-code>

<x-ul>
    <li><code>$label</code> - лейбл, заголовок поля,</li>
    <li><code>$relationName</code> - название отношения,</li>
    @if($field !== 'HasOne' &&  $field !== 'HasMany')
    <li><code>$formatted</code> - замыкание или поле в связанной таблице для отображения значений,</li>
    @endif
    <li><code>$resource</code> - ресурс модели на которую ссылается отношение.</li>
</x-ul>

@if($field === 'HasOne' || $field === 'HasMany')
<x-moonshine::alert type="error" icon="heroicons.information-circle">
    Параметр <code>$formatted</code> не используется в поле <code>{{ $field }}</code>!
</x-moonshine::alert>
@endif

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Наличие ресурса модели, на которую ссылается отношение, обязательно!<br />
    Ресурс также необходимо <x-link link="{{  to_page('resources-index') }}#define">зарегистрировать</x-link> в сервис провайдере <em>MoonShineServiceProvider</em> в методе
    <code>menu()</code> или <code>resources()</code>. Иначе, будет 404 ошибка.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', '{{ str($label)->lower() }}', resource: new {{ str($label)->singular()->studly() }}Resource()) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/' . str($field)->snake('_')->append('.png')) }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/' . str($field)->snake('_')->append('_dark.png')) }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если не указать <code>$relationName</code>,
    то название отношения будет определено автоматически на основе <code>$label</code>.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource()) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Можно не указывать <code>$resource</code>, если ресурс модели соответствует названию отношения.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', '{{ str($label)->lower() }}') // [tl! focus]
    ];
}

//...
</x-code>

@if($field !== 'HasOne' && $field !== 'HasMany')

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию для отображения значения используется поле в связанной таблице,
    которе задано свойством <code>$column</code> в ресурсе модели.<br />
    Аргумент <code>$formatted</code> позволяет это переопределить.
</x-moonshine::alert>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class {{ str($label)->singular()->studly() }}Resource extends ModelResource
{
    //...

    public string $column = 'title'; // [tl! focus]

    //...
}
</x-code>

<x-p>
    Если необходимо задать более сложное значение для отображения,
    то аргументу <code>$formatted</code> можно передать callback функцию.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make(
            '{{ $label }}',
            '{{ str($label)->lower() }}',
            fn($item) => "$item->id. $item->title" // [tl! focus]
        )
    ];
}

//...
</x-code>

@endif
