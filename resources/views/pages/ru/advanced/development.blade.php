<x-page title="Расширения" :sectionMenu="[
    'Разделы' => [
        ['url' => '#custom-field', 'label' => 'Кастомное поле'],
        ['url' => '#custom-action', 'label' => 'Кастомное действие'],
    ]
]">

<x-p>
    MoonShine дает возможности расширения основного функционала и написания собственных пакетов, которые улучшат возможности.
    В данном разделе мы приведем список таких пакетов, пример с созданием собственного поля и действия.
</x-p>

<x-p>
    Если у вас сложности с тем, как должен выглядеть ваш пакет для MoonShine, то мы приготовили для вас готовый шаблон.
    <x-moonshine::link href="https://github.com/moonshine-software/moonshine-package-template">
        Шаблон
    </x-moonshine::link>
</x-p>

<x-p>
    Следующие сущности могут быть расширены:
    <x-ul :items="['Fields', 'Filters', 'Decorations', 'Actions', 'Metrics', 'InputExtension', 'FormComponent', 'Resource']"></x-ul>
</x-p>

<x-sub-title id="custom-field">Кастомное поле</x-sub-title>

<x-p>
    Рассмотрим небольшой пример создания собственного поля!
    Это будет визуальный редактор на основе js плагина CKEditor
</x-p>

<x-p>
    Для начала создадим класс, который расширяет MoonShine поля
</x-p>

<x-code language="php">
namespace App\MoonShine\Fields;

use MoonShine\Fields\Field;

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

<x-sub-title id="custom-action">Кастомное действие</x-sub-title>

<x-p>
    В MoonShine уже есть несколько встроенных действий, таких как
    <x-link :link="route('moonshine.custom_page', 'actions-export')">Экспорт</x-link> и
    <x-link :link="route('moonshine.custom_page', 'actions-import')">Импорт</x-link>,
    но вы также можете создавать свои собственные действия.
</x-p>

<x-p>
    Для этого вам нужно создать класс, который расширяет класс действия MoonShine и определить метод handle.
</x-p>

<x-code language="php">
namespace App\MoonShine\Actions;

use MoonShine\Actions\Action;

class CustomAction extends Action
{
    public function handle(): mixed
    {
        // Код с логикой обработчика
    }
}
</x-code>

<x-p>
    Этого уже достаточно, чтобы отобразить наше действие на странице ресурса.
    Однако, давайте рассмотрим, что еще можно определить в нашем классе действия.
</x-p>

<x-code language="php">
class CustomAction extends Action
{
    protected static string $view = 'view.custom'; // Собственное blade отображение

    protected bool $withQuery = true; // Если необходимо передавать в url действия, весь текущий getQuery

    protected bool $inDropdown = false; // Отображать кнопку вне выпадающего списка

    protected ?string $icon = 'heroicons.outline.table-cells'; // Иконка для кнопки
}
</x-code>

<x-p>
    Затем зарегистрируйте действие в методе actions ресурса, в котором вы хотите отобразить его.
</x-p>

<x-code language="php">
public function actions(): array
{
    return [
        CustomAction::make('Кастомное действие'),
    ];
}
</x-code>

<x-p>
    Готово!
</x-p>
</x-page>
