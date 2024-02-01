<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Если необходимо получать данные асинхронно (например при пагинации),
    то воспользуйтесь методом <code>async()</code>.
</x-p>

<x-code language="php">
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
</x-code>

<x-ul>
    <li><code>asyncUrl</code> - url запроса (по умолчанию запрос отправляется по текущему url),</li>
    <li><code>asyncEvents</code> - вызываемые события после успешного запроса,</li>
    <li><code>asyncCallback</code> - js callback функция после получения ответа.</li>
</x-ul>

<x-code language="php">
{{ $element }}::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->async() // [tl! focus]
</x-code>

<x-p>
    После успешного запроса, можно вызвать события, добавив параметр <code>asyncEvents</code>.
</x-p>

<x-code language="php">
{{ $element }}::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('crud') // [tl! focus]
    ->async(asyncEvents: ['{{ $element == 'CardsBuilder' ? 'cards-updated-crud' : 'table-updated-crud' }}']) // [tl! focus]
</x-code>

<x-p>
    В MoonShine уже есть набор готовых событий:
</x-p>

<x-ul>
    <li><code>table-updated-{name}</code> - асинхронное обновление таблицы по имени,</li>
    <li><code>cards-updated-{name}</code> - асинхронное обновление группы каточек по имени,</li>
    <li><code>form-reset-{name}</code> - сброс значений формы по имени,</li>
    <li><code>fragment-updated-{name}</code> - обновление blade fragment по имени.</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Для вызова события обязательно необходимо задать уникальное
    <x-link link="{{ route('moonshine.page', 'components-moonshine_component') }}#name">имя компонента</x-link>!
</x-moonshine::alert>
