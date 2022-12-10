<x-page title="WYSIWYG">

<x-p>Текстовый редактор с плагином trix/ckeditor/quill</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\WYSIWYG;
use Leeto\MoonShine\Fields\CKEditor;
use Leeto\MoonShine\Fields\Quill;

//...
public function fields(): array
{
    return [
        WYSIWYG::make('Описание', 'description'), // Trix
        // или
        CKEditor::make('Описание', 'description'), // CKEditor
        // или
        Quill::make('Описание', 'description'), // Quill
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/wysiwyg.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-code') }}">Код</x-next>

</x-page>



