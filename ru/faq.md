# FAQ

## Как использовать отношения в MoonShine?

**Eloquent** отношения в **MoonShine** реализуются через соответствующие одноименные поля.

**MoonShine** поддерживает все возможные отношения: `BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany` и другие.

Рассмотрим использование полей отношений на примере `BelongsTo`. Например, у вас есть модели `Post` и `Author`, где каждый пост принадлежит одному автору.

```php
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// В модели Post
public function author(): BelongsTo
{
    return $this->belongsTo(Author::class);
}
```

```php
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

// В MoonShine PostResource
public function formFields(): array
{
    return [
        // ...
        BelongsTo::make('Author', 'author', AuthorResource::class),
    ];
}
```

Подробнее о каждом типе связи читайте в разделах соответствующих полей в документации.

## Как работать с JSON полями в MoonShine?

Смотрите раздел поля [Json](/docs/{{version}}/fields/json).

##  Как добавить стили или классы к полям или компонентам?

[Добавление класса](/docs/{{version}}/components/attributes#class).

[Добавление стиля](/docs/{{version}}/components/attributes#style).
