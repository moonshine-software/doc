<x-page title="Package development" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#service-provider', 'label' => 'ServiceProvider'],
        ['url' => '#custom-field', 'label' => 'Custom field example'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>
<x-p>
Основой MoonShine являются пакеты Laravel. Если вы новичок в разработке пакетов для Laravel, вот несколько ресурсов, которые помогут вам понять основные концепции:

<x-ul>
    <li>Раздел <x-link link="https://laravel.com/docs/packages">«Package development»</x-link> документации Laravel служит отличным справочным руководством.</li>
    <li><x-link link="https://learn.cutcode.dev/moonshine">Курс от CutCode по разработке пакетов</x-link></li>
    <li><x-link link="https://youtu.be/a_udqxegrRI?si=F8F_v8uGLGLkEbpQ">Бесплатный гайд от CutCode по разработке пакетов</x-link></li>
</x-ul>
</x-p>

<x-sub-title id="service-provider">ServiceProvider</x-sub-title>

<x-p>
    Через ServiceProvider Вашего пакета вы можете добавлять автоматически ресурсы, страницы, формировать меню и правила авторизации и многое другое.
</x-p>

<x-code>
namespace Author\MoonShineMyPackage;

use Illuminate\Support\ServiceProvider;

class MyPackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        moonshine()
            ->resources([
                new MyPackageResource(),
            ])
            ->pages([
                new MyPackagePage(),
            ])
            ->vendorsMenu([
                MenuItem::make('MyPage', new MyPackagePage())
            ]);
    }
}
</x-code>

<x-p>
    Также вы можете взаимодействовать с AssetManager или ColorManager
</x-p>

<x-code>
public function boot(): void
{
    moonshineAssets()->add([
        'path_to_file.css',
        'path_to_file.js',
    ]);
}
</x-code>

<x-code>
public function boot(): void
{
    moonshineColors()
        ->background('#A3C3D9')
        ->content('#A3C3D9')
        ->tableRow('#AE76A6')
        ->dividers('#AE76A6')
        ->borders('#AE76A6')
        ->buttons('#AE76A6')
        ->primary('#CCD6EB')
        ->secondary('#AE76A6');
}
</x-code>

<x-p>
Если необходимо добавить дополнительную логику авторизации в приложении или во внешнем пакете, то воспользуйтесь методом <code>defineAuthorization</code>.
</x-p>

<x-code>
public function boot(): void
{
    moonshine()->defineAuthorization(
        static function (ResourceContract $resource, Model $user, string $ability): bool {
            return true;
        }
    );
}
</x-code>

<x-p>
    Не забудьте автоматически подключить Ваш <code>ServiceProvider</code> в <code>composer.json</code>
</x-p>

<x-code language="json">
"extra": {
    "laravel": {
        "providers": [
            "Author\\MoonShineMyPackage\\MyPackageServiceProvider"
        ]
    }
}
</x-code>

<x-sub-title id="custom-field">Custom field example</x-sub-title>

<x-p>
    Рассмотрим небольшой пример создания собственного поля! Это будет визуальный редактор на основе js плагина Quill
</x-p>

<x-p>
    Создадим поле с помощью команды <code>moonshine:field</code> и выберем что оно расширяет Textarea
</x-p>

<x-code language="shell">
php artisan moonshine:field Quill
</x-code>

<x-p>
    Уберем лишние методы и добавим css/js
</x-p>

<x-code>
declare(strict_types=1);

namespace App\MoonShine\Fields;

use MoonShine\Fields\Textarea;

final class Quill extends Textarea
{
    protected string $view = 'moonshine-quill::fields.quill';

    protected array $assets = [
        '/css/moonshine/quill/quill.snow.css', // theme
        '/js/moonshine/quill/quill.js', // lib
        '/js/moonshine/quill/quill-init.js', // init
    ];
}
</x-code>

<x-p>
    Также изменим view поля
</x-p>

<x-code
    language="js"
    file="resources/views/examples/components/quill.blade.php"
/>

<x-p>
    quill.snow.css и quill.js мы взяли из библиотеки, а вот js инициализации с использованием alpineJs представлен ниже
</x-p>

<x-code language="js">
document.addEventListener('alpine:init', () => {
    Alpine.data('quill', () => ({
        textarea: null,
        editor: null,

        init() {
            this.textarea = this.$root.querySelector('.ql-textarea')
            this.editor = this.$root.querySelector('.ql-editor')

            const t = this

            this.$nextTick(function() {
                let quill = new Quill(`#${t.editor.id}`, {
                    theme: 'snow'
                });

                quill.on('text-change', () => {
                    t.textarea.value = t.editor.innerHTML || '';
                    t.textarea.dispatchEvent(new Event('change'));
                });
            })
        },
    }))
})
</x-code>

<x-p>
    Пример выноса этого поля в отдельный пакет можно найти
    <x-link link="https://github.com/moonshine-software/quill">в репозитории</x-link>
</x-p>
</x-page>
