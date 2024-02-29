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
    Рассмотрим небольшой пример создания собственного поля! Это будет визуальный редактор на основе js плагина CKEditor
</x-p>

<x-p>
    Создадим поле с помощью команды <code>moonshine:field</code> и выберем что оно расширяет Textarea
</x-p>

<x-code language="shell">
php artisan moonshine:field CKEditor
</x-code>

<x-p>
    Уберем лишние методы и добавим css
</x-p>

<x-code>
namespace App\MoonShine\Fields;

use MoonShine\Fields\Textarea;
use Closure;

class CKEditor extends Textarea
{
    protected string $view = 'admin.fields.c-k-editor';

    protected array $assets = [
        'https://cdn.ckeditor.com/ckeditor5/35.3.0/super-build/ckeditor.js'
    ];
}
</x-code>

<x-p>
    Также изменим view поля, реализуем js прямо в blade, но лучшим решением будет вынести в отдельный js файл
</x-p>

<x-code
    language="js"
    file="resources/views/examples/components/ckeditor.blade.php"
/>

</x-page>
