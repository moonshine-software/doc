<x-sub-title id="async">Asynchronous mode</x-sub-title>

<x-p>
    If you need to receive data asynchronously (for example, during pagination),
    then use the <code>async()</code> method.
</x-p>

<x-code language="php">
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
</x-code>

<x-ul>
    <li><code>asyncUrl</code> - request url (by default, the request is sent to the current url),</li>
    <li><code>asyncEvents</code> - events called after a successful request,</li>
    <li><code>asyncCallback</code> - js callback function after receiving a response.</li>
</x-ul>

<x-code language="php">
{{ $element }}::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->async() // [tl! focus]
</x-code>

<x-p>
    After a successful request, you can raise events by adding the <code>asyncEvents</code> parameter.
</x-p>

<x-code language="php">
{{ $element }}::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('crud') // [tl! focus]
    ->async(asyncEvents: ['{{ $element == 'CardsBuilder' ? 'cards-updated-crud' : 'table-updated-crud' }}']) // [tl! focus]
</x-code>

<x-p>
    MoonShine already has a set of ready-made events:
</x-p>

<x-ul>
    <li><code>table-updated-{name}</code> - asynchronous table update by name</li>
    <li><code>cards-updated-{name}</code> - asynchronous update of a group of cards by name,</li>
    <li><code>form-reset-{name}</code> - reset form values by name,</li>
    <li><code>fragment-updated-{name}</code> - updating blade fragment by name.</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    To trigger an event, you must specify a unique
    <x-link link="{{ route('moonshine.page', 'components-moonshine_component') }}#name">component name</x-link>!
</x-moonshine::alert>
