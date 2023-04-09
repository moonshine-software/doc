<x-page title="Телефон">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Все то же самое как и "Текстовое поле", меняется только input type = tel
</x-p>

<x-code language="php">
use MoonShine\Fields\Phone;

Phone::make('Телефон', 'tel')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">Для маски телефона воспользуйтесь методом mask('7 999 999-99-99')</x-moonshine::alert>

</x-page>
