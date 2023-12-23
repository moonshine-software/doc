<x-sub-title id="update-on-preview">Редактирование в preview</x-sub-title>

<x-p>
    Метод <code>updateOnPreview()</code> позволяет редактировать поле <em>{{ $field }}</em> в режиме <em>preview</em>.
</x-p>

<x-code language="php">
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
</x-code>

<x-ul>
    <li><code>$url</code> - url для обработки асинхронного запроса,</li>
    <li><code>$resource</code> - ресурс модели на которую ссылается отношение,</li>
    <li><code>$condition</code> - условие выполнения метода.</li>
</x-ul>

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
