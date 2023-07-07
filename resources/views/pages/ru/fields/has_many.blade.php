<x-page title="HasMany">

<x-p>Поле для отношений в Laravel типа hasMany</x-p>

<x-code language="php">
use MoonShine\Fields\HasMany;

//...
public function fields(): array
{
    return [
        HasMany::make('Comments')
            ->fields([
                ID::make(),
                BelongsTo::make('Article'),
                BelongsTo::make('User'),
                Text::make('Text')->required(),
            ])
            ->removable()
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поле ID в методе fields обязательно
</x-moonshine::alert>

<x-p>
    Часто бывает, что полей для связи крайне много и в таблице они отображаются мелко и неудобно.
    Во многих случаях необходимо выносить такую связь в отдельный ресурс, однако если необходимо
    оставить в рамках текущего ресурса, но отобразить поля полноценно, тогда воспользуйтесь
    методом <code>fullPage()</code>, и поля примут стандартный вид
</x-p>

<x-image theme="light" src="{{ asset('screenshots/has_many.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_dark.png') }}"></x-image>

<x-p>
    Все же режим table и fullPage больше подойдет для отношений с примитивными полями, такие режимы
    не поддерживают поля Json, HasOne, HasMany и многие другие.
    Но можно переключить поле в режим ресурса <code>ResourceMode</code> и тем самым рендерить список связанных записей либо связанную форму
    как полноценный ресурс.
    Для этого необходимо указать у поля метод <code>resourceMode()</code> и в таком случае не придется указывать набор полей
    в методе <code>fields()</code>, но вот связанный ресурс с полями будет обязательным
</x-p>

<x-code language="php">
use MoonShine\Fields\HasMany;

//...
public function fields(): array
{
    return [
        HasMany::make('Расценки', 'prices', new PriceResource())
            ->resourceMode()
    ];
}

//...
</x-code>

<x-p>
    Обратите внимание, наличие ресурса в таком режиме - обязательный критерий.
    Однако его можно не указывать, если он не нарушает конвенцию наименований. В таком случае ресурс будет найден автоматически.
</x-p>

<x-image theme="light" src="{{ asset('screenshots/resource_mode.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_mode_dark.png') }}"></x-image>

</x-page>
