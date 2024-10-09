# Markdown 

- [Основы](#basics)  
- [Панель инструментов](#toolbar)  
- [Опции](#options)  
- [Глобальная конфигурация](#global-configuration)  

Расширяет [Textarea](https://moonshine-laravel.com/docs/resource/fields/fields-textarea)
* имеет те же функции

<a name="basics"></a>  
## Основы  

**Markdown** - это легковесный язык разметки, предназначенный для форматирования обычного текста с максимальной читаемостью для человека.  

```php
use MoonShine\Fields\Markdown;

//...

public function fields(): array
{
    return [
        Markdown::make('Description')
    ];
}

//...
```
![markdown](https://moonshine-laravel.com/screenshots/markdown.png)
![markdown_dark](https://moonshine-laravel.com/screenshots/markdown_dark.png)

![markdown](https://moonshine-laravel.com/screenshots/markdown_preview.png)
![markdown_preview_dark](https://moonshine-laravel.com/screenshots/markdown_preview_dark.png)


<a name="toolbar"></a>  
## Панель инструментов  

Метод `toolbar()` позволяет изменить панель инструментов.  

```php
toolbar(string|bool|array $value)
```

```php
use MoonShine\Fields\Markdown;

//...

Markdown::make('Description')
    ->toolbar(['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule'])
```

<a name="options"></a>  
## Опции  

Метод `addOption()` позволяет добавить или изменить опции для редактора markdown.  

```php
addOption(string $name, string|int|float|bool|array $value)
```

```php
use MoonShine\Fields\Markdown;

//...

Markdown::make('Description')
    ->addOption('toolbar',  ['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule'])
```

<a name="global-configuration"></a>  
## Глобальная конфигурация  

Если вам нужно изменить настройки для редактора глобально, вы можете использовать статический метод `setDefaultOption()`.

```php
setDefaultOption(string $name, string|int|float|bool|array $value)
```

```php
namespace App\Providers;

use MoonShine\Fields\Markdown;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Markdown::setDefaultOption('toolbar',  ['bold', 'italic', 'strikethrough', 'code', 'quote']);
    }
}
```
