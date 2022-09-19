<x-page title="Основы">

<x-p>
    Рассмотрим небольшой пример создания собственного поля!
    Скажем пусть это будет визуальный редактор на основе js плагина CKEditor
</x-p>

<x-p>
    Для начала создадим класс который расширяет MoonShine поля
</x-p>

<x-code lang="php">
namespace App\MoonShine\Fields;

use Leeto\MoonShine\Fields\Field;

class CKEditorField extends Field
{
    // Путь до view с реализацией поля
    protected static string $view = 'PATH_TO_VIEW.ckeditor';

    // Необходимые дополнительные assets
    protected array $assets = [
        'https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js',
    ];
}
</x-code>

<x-p>
    И создаем view с реализацией
</x-p>

<x-code lang="html">
    <div id="ckeditor_{{ $field->id() }}">
        {!! $field->formViewValue($item) ?? '' !!}
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#ckeditor_{{ $field->id() }}' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-code>

<x-p>
    Вот и все!
</x-p>

</x-page>
