<x-page title="HasOne">

<x-extendby :href="route('moonshine.custom_page', 'fields-has_many')">
    HasMany
</x-extendby>

<x-p>Поле для отношений в laravel типа hasOne</x-p>

<x-p>Создает новую запись в связанной таблице и привязывает к текущей записи</x-p>

<x-p>При существовании связи запись редактируется</x-p>

<x-code language="php">
use MoonShine\Fields\HasOne;

//...
public function fields(): array
{
    return [
        HasOne::make('Город', 'city', 'name')
            ->fields([
                ID::make(),
                Text::make('Значение', 'name'),
            ])
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поле ID в методе fields обязательно
</x-moonshine::alert>

<x-p>
    Часто бывает, что полей для связи крайне много и в таблице они отображаются мелко и неудобно.
    Во многих случаях необходимо выносить такую связь в отдельный ресурс, однако, если необходимо
    оставить связь в рамках текущего ресурса, но отобразить поля полноценно, воспользуйтесь
    методом <code>fullPage()</code>, и поля примут стандартный вид
</x-p>

<x-image theme="light" src="{{ asset('screenshots/has_one_1.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_1_dark.png') }}"></x-image>

<x-image theme="light" src="{{ asset('screenshots/has_one_2.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_2_dark.png') }}"></x-image>

<x-p>
    Также доступен <code>resourceMode</code>, подробности в поле HasMany
</x-p>

</x-page>
