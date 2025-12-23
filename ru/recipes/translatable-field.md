# Поля для нескольких языков

Простой способ сделать любое поле поддерживающее несколько языков, без дополнительных пакетов

Подходит для Spatie laravel-translatable или если вы как они, храните все переводу в json поле,
такого вида: `{"ru": "Текст", "en": "Text"}`

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Fields;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Fields\Json;

final readonly class Translatable
{
    public static function make(
        string $label,
        string $column,
        FieldContract $field
    ): Json {
        $locales = collect(moonshine()->getConfig()->getLocales());

        return Json::make($label, $column)
            ->object()
            ->fields(
                $locales->map(
                    fn (string $locale) => (clone $field)
                        ->setLabel(\Str::upper($locale))
                        ->setColumn($locale)
                )
                ->all(),
            )
            ->removeClass('space-elements')
            ->class('flex gap-6')
            ->changeFill(function (Model $data) use ($column) {
                return $data->getRawOriginal($column);
            });
    }
}
```

Использовать так

```php
Translatable::make(
    trans('admin.resource.title'),
    'title',
    Text::make(),
),
```
