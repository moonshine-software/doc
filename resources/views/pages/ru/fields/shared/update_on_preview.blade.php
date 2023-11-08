<x-sub-title id="update-on-preview">Редактирование в preview</x-sub-title>

<x-p>
    Метод <code>updateOnPreview()</code> позволяет редактировать поле <em>{{ $field }}</em> в режиме <em>preview</em>.
</x-p>

<x-code language="php">
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
</x-code>

<x-p>
    <code>$url</code> - url для обработки асинхронного запроса,<br>
    <code>$resource</code> - ресурс модели на которую ссылается отношение,<br>
    <code>$condition</code> -условия выполнения метода.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Параметры не являются обязательными и их необходимо передавать, если поле работает вне ресурса.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make({!! $field === 'Checkbox' ? 'Public' : 'Country' !!})
            ->updateOnPreview() // [tl! focus]
    ];
}

//...
</x-code>
