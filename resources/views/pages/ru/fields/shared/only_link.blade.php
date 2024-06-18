<x-sub-title id="only-link">Только ссылка</x-sub-title>

<x-p>
    Метод <code>onlyLink()</code> позволят отобразить отношение в виде ссылки с количеством элементов.
</x-p>

<x-code language="php">
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
</x-code>

<x-p>
    Методу можно передать необязательные параметры:
    <x-ul>
        <li><code>linkRelation</code> - ссылка на отношение;</li>
        <li>
            <code>condition</code> - замыкание или булево значение,
            отвечающее за отображение отношения как ссылки.
        </li>
    </x-ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->onlyLink() // [tl! focus]
    ];
}

//...
</x-code>

@if ($field === 'HasMany')
<x-image theme="light" src="{{ asset('screenshots/has_many_link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_link_dark.png') }}"></x-image>
@endif

<x-moonshine::divider label="linkRelation"></x-moonshine::divider>

<x-p>
    Параметр <code>linkRelation</code> позволяет создать ссылку на отношение с привязкой родительского ресурса.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->onlyLink('{{ str($label)->singular()->studly()->lower() }}') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="condition"></x-moonshine::divider>

<x-p>
    Параметр <code>condition</code> через замыкание позволят изменять способ отображения в зависимости от условий.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>
