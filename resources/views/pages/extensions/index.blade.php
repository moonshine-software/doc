<x-page title="Основы">

<x-p>
    Рассмотрим небольшой пример создания собственного поля!
    Скажем пусть это будет визуальный редактор на основе js плагина CKEditor
</x-p>

<x-p>
    Для начала создадим класс который расширяет MoonShine поля
</x-p>

<x-code language="php">
namespace App\MoonShine\Fields;

use Leeto\MoonShine\Fields\Field;

final class CKEditor extends Field
{
    protected static string $view = 'fields.ckeditor';

    protected array $assets = [
        'https://cdn.ckeditor.com/ckeditor5/35.3.0/super-build/ckeditor.js'
    ];
}

</x-code>

<x-p>
    И создаем view с реализацией
</x-p>

<x-code language="blade" file="examples/extensions/ckeditor.blade.php"></x-code>

<x-p>
    Вот и все!
</x-p>

</x-page>
