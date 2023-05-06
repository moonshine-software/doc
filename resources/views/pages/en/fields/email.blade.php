<x-page title="E-mail">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Everything is the same as "Text Box", the only difference is input type = email
</x-p>

<x-code language="php">
use MoonShine\Fields\Email;

Email::make('E-mail', 'email')
</x-code>

</x-page>
