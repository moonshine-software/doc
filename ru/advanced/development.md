# Разработка пакетов

- [Основы](#basics)
- [ServiceProvider](#serviceprovider)
- [Пример пользовательского поля](#custom-field-example)

---

<a name="basics"></a>
## Основы

MoonShine основан на пакетах Laravel. Если вы новичок в разработке пакетов Laravel, вот несколько ресурсов, которые помогут вам понять основные концепции:

- Глава [«Разработка пакетов»](https://laravel.com/docs/packages) в документации Laravel служит отличным справочным руководством.
- [Курс по разработке пакетов от CutCode](https://learn.cutcode.dev/moonshine)
- [Бесплатное руководство по разработке пакетов от CutCode](https://youtu.be/a_udqxegrRI?si=F8F_v8uGLGLkEbpQ)

<a name="serviceprovider"></a>
## ServiceProvider

Через ServiceProvider вашего пакета вы можете автоматически добавлять ресурсы, страницы, создавать меню и правила авторизации, и многое другое.

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

Также вы можете взаимодействовать с AssetManager или ColorManager

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

Если вам нужно добавить дополнительную логику авторизации в приложение или во внешний пакет, используйте метод `defineAuthorization`

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

Не забудьте автоматически подключить ваш `ServiceProvider` в `composer.json`

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
## Пример пользовательского поля

Давайте быстро рассмотрим создание собственного поля! Это будет визуальный редактор на основе плагина Quill js

Создадим поле с помощью команды `moonshine:field` и выберем, что оно расширяет Textarea

```php
php artisan moonshine:field Quill
```

Удалим ненужные методы и добавим css/js

```php
declare(strict_types=1);

namespace App\MoonShine\Fields;

use MoonShine\Fields\Textarea;

final class Quill extends Textarea
{
    protected string $view = 'moonshine-quill::fields.quill';

    protected array $assets = [
        '/css/moonshine/quill/quill.snow.css', // тема
        '/js/moonshine/quill/quill.js', // библиотека
        '/js/moonshine/quill/quill-init.js', // инициализация
    ];
}
```

Также изменим представление поля

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

Мы взяли quill.snow.css и quill.js из библиотеки, а инициализация js с использованием alpineJs представлена ниже

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

Пример размещения этого поля в отдельном пакете можно найти [в репозитории](https://github.com/moonshine-software/quill)
