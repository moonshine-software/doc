# Markdown 

- [Basics](#basics)  
- [Toolbar](#toolbar)  
- [Options](#options)  
- [Global configuration](#global-configuration)  

Extends [Textarea](https://moonshine-laravel.com/docs/resource/fields/fields-textarea)
* has the same features

<a name="basics"></a>  
## Basics  

**Markdown** a lightweight markup language designed to indicate formatting in plain text, while maximizing its human readability.  

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
![markdown](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/markdown.png)
![markdown_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/markdown_dark.png)

![markdown](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/markdown_preview.png)
![markdown_preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/markdown_preview_dark.png)


<a name="toolbar"></a>  
## Toolbar  

The `toolbar()` method allows you to change the toolbar.  

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
## Options  

The `addOption()` method allows you to add or change options for the markdown editor.  

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
## Global configuration  

If you need to change settings for the editor globally, you can use the static method `setDefaultOption()`.

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
