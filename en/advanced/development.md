https://moonshine-laravel.com/docs/resource/advanced/advanced-development?change-moonshine-locale=en

------

# Package development

- [Basics](#basics)
- [ServiceProvider](#serviceprovider)
- [Custom field example](#custom-field-example)

<a name="basics"></a>
### Basics

MoonShine is based on Laravel packages. If you're new to Laravel package development, here are some resources to help you understand the basic concepts:

- Chapter [«Package development»](https://laravel.com/docs/packages) Laravel documentation serves as an excellent reference guide.
- [CutCode Package Development Course](https://learn.cutcode.dev/moonshine)
- [CutCode's free guide to package development](https://youtu.be/a_udqxegrRI?si=F8F_v8uGLGLkEbpQ)

<a name="serviceprovider"></a>
### ServiceProvider

Through the ServiceProvider of your package, you can automatically add resources, pages, create menus and authorization rules, and much more.

```php
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
```

Also you can interact with AssetManager or ColorManager

```php
public function boot(): void
{
    moonshineAssets()->add([
        'path_to_file.css',
        'path_to_file.js',
    ]);
}
```

```php
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
```

If you need to add additional authorization logic in an application or in an external package, then use the method `defineAuthorization`

```php
public function boot(): void
{
    moonshine()->defineAuthorization(
        static function (ResourceContract $resource, Model $user, string $ability): bool {
            return true;
        }
    );
}
```

Don't forget to automatically connect your `ServiceProvider` in `composer.json`

```json
"extra": {
    "laravel": {
        "providers": [
            "Author\\MoonShineMyPackage\\MyPackageServiceProvider"
        ]
    }
}
```

<a name="custom-field-example"></a>
### Custom field example

Let's take a quick look at creating your own field! This will be a visual editor based on the Quill js plugin

Let's create a field using the `moonshine:field` command and select that it extends Textarea

```php
php artisan moonshine:field Quill
```

Let's remove unnecessary methods and add css/js

```php
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
```

Let's also change the view fields

```js
<div x-data="quill">
    <div class="ql-editor" :id="$id('quill')" style="height: auto;">{!! $value ?? '' !!}</div>
  
    <x-moonshine::form.textarea
        :attributes="$element->attributes()->merge([
            'class' => 'ql-textarea',
            'name' => $element->name(),
            'style' => 'display: none;'
        ])->except('x-bind:id')"
    >{!! $value ?? '' !!}</x-moonshine::form.textarea>
</div>
```

We took quill.snow.css and quill.js from the library, but js initialization using alpineJs is presented below

```js
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
```

An example of placing this field in a separate package can be found [in the repository](https://github.com/moonshine-software/quill)
