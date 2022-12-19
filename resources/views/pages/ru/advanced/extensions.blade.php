<x-page title="Основы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#custom-field', 'label' => 'Кастомное поле'],
        ['url' => '#vendors', 'label' => 'Пакеты'],
    ]
]">

<x-p>
    MoonShine дает возможности расширения основного функционала и написания собственных пакетов которые улучшать возможности.
    В данном разделе мы приведем список таких пакетов и пример с созданием собственного поля
</x-p>

<x-sub-title id="custom-field">Кастомное поле</x-sub-title>

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

<x-sub-title id="vendors">Пакеты</x-sub-title>

<x-link link="https://github.com/visual-ideas/laravel-site-settings">Менеджер настроек</x-link>

</x-page>
