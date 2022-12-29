<x-page title="HasOne">

<x-p>Поле для отношений в laravel типа hasOne</x-p>

<x-p>Создает новую запись в связанной таблице и привязывает к текущей записе</x-p>

<x-p>При существованнии связи, запись редактируется</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\HasOne;

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

<x-p>
    Часто бывает что полей для связи крайне много и в таблице они отображаются мелко и не удобно.
    Во многих случаях необходимо выносить такую связь в отдельный ресурс, но если необходимо
    оставить в рамках текущего ресурса, но отобразить поля полноценно, тогда воспользуйтесь
    методом <code>fullPage()</code> и поля примут стандартный вид
</x-p>

<x-image src="{{ asset('screenshots/has_one_1.png') }}"></x-image>
<x-image src="{{ asset('screenshots/has_one_2.png') }}"></x-image>

<x-p>
    Также доступен <code>resourceMode</code>, подробности в поле HasMany
</x-p>

</x-page>



