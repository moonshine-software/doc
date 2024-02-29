<x-page title="Package development" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#service-provider', 'label' => 'ServiceProvider'],
        ['url' => '#custom-field', 'label' => 'Custom field example'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>
<x-p>
MoonShine is based on Laravel packages. If you're new to Laravel package development, here are some resources to help you understand the basic concepts:

<x-ul>
    <li>Chapter <x-link link="https://laravel.com/docs/packages">«Package development»</x-link> Laravel documentation serves as an excellent reference guide.</li>
    <li><x-link link="https://learn.cutcode.dev/moonshine">CutCode Package Development Course</x-link></li>
    <li><x-link link="https://youtu.be/a_udqxegrRI?si=F8F_v8uGLGLkEbpQ">CutCode's free guide to package development</x-link></li>
</x-ul>
</x-p>

<x-sub-title id="service-provider">ServiceProvider</x-sub-title>

<x-p>
    Through the ServiceProvider of your package, you can automatically add resources, pages, create menus and authorization rules, and much more.
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
    Also you can interact with AssetManager or ColorManager
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
If you need to add additional authorization logic in an application or in an external package, then use the method <code>defineAuthorization</code>.
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
    Don't forget to automatically connect your <code>ServiceProvider</code> in <code>composer.json</code>
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
    Let's take a quick look at creating your own field! This will be a visual editor based on a js plugin CKEditor
</x-p>

<x-p>
    Let's create a field using the <code>moonshine:field</code> command and select that it extends Textarea
</x-p>

<x-code language="shell">
php artisan moonshine:field CKEditor
</x-code>

<x-p>
    Let's remove unnecessary methods and add css
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
    We will also change the view fields, implement js directly in the blade, but the best solution would be to put it in a separate js file
</x-p>

<x-code
    language="js"
    file="resources/views/examples/components/ckeditor.blade.php"
/>

</x-page>
