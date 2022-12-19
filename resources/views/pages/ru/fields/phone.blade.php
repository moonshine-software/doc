<x-page title="Телефон">

<x-p>
    Все тоже самое как и "Текстовое поле", меняется только input type = tel
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Phone;

Phone::make('Телефон', 'tel')
</x-code>

<x-alert>Для маски телефона воспользуйтесь методом mask('7 999 999-99-99')</x-alert>

</x-page>



