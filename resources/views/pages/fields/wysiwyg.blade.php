<x-page title="WYSIWYG">

<x-p>Текстовый редактор с плагином trix</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\WYSIWYG;

//...
public function fields(): array
{
    return [
        WYSIWYG::make('Описание', 'description')
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/wysiwyg.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-code') }}">Код</x-next>

</x-page>



