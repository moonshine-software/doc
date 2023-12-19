<x-sub-title id="update-on-preview">Editing in preview</x-sub-title>

<x-p>
    The <code>updateOnPreview()</code> method allows you to edit the <em>{{ $field }}</em> field in <em>preview</em> mode.
</x-p>

<x-code language="php">
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
</x-code>

<x-ul>
    <li><code>$url</code> - url for processing an asynchronous request,</li>
    <li><code>$resource</code> - the model resource referenced by the relation,</li>
    <li><code>$condition</code> - condition for executing the method.</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Parameters are optional and must be passed if the field operates outside of a resource.
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
