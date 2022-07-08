<x-page title="HasMany">

<x-p>Поле для отношений в laravel типа hasMany</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\HasMany;

//...
public function fields(): array
{
    return [
        HasMany::make('Расценки', 'prices')
            ->fields([
                ID::make(),
                BelongsTo::make('Услуга', 'service_id', 'name'),
                Number::make('Стоимость', 'price'),
                Number::make('Продолжительнось', 'duration'),
            ])
            ->removable()
    ];
}
//...
</x-code>

<x-p>
    Часто бывает что полей для связи крайне много и в таблице они отображаются мелко и не удобно.
    Во многих случаях необходимо выности такую связь в отдельный ресурс, но если необходимо
    оставить в рамках текущего ресурса, но отобразить поля полноценно, тогда воспользуйтесь
    методом <code>fullPage()</code> и поля примут стандартный вид
</x-p>

<x-image src="{{ asset('screenshots/has_many.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-has_many_through') }}">HasManyThrough</x-next>

</x-page>



