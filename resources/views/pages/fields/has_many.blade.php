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

<x-image src="{{ asset('screenshots/has_many.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-has_many_through') }}">HasManyThrough</x-next>

</x-page>



