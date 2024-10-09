# Template

*Template* не имеет готовой реализации и позволяет конструировать поле, используя *fluent interface* в процессе декларации.

```php
use MoonShine\Fields\Template;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Template::make('МоеПоле')
            ->setLabel('Мое Поле')
            ->fields([
                Text::make('Заголовок')
            ])
    ];
}

//...
```

> [!TIP]
> Рецепт: [Отношение HasOne через поле Template](https://moonshine-laravel.com/docs/resource/recipes/recipes#hasone-through-template).
