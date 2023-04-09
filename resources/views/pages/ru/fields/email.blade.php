<x-page title="E-mail">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Все то же самое как и "Текстовое поле", меняется только input type = email
</x-p>

<x-code language="php">
use MoonShine\Fields\Email;

Email::make('E-mail', 'email')
</x-code>

</x-page>
