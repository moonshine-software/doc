<x-page title="Разделитель">

<x-p>
    Для разделения на зоны, можно воспользоваться декорацией <code>Divider</code>
</x-p>

<x-code language="php">
use MoonShine\Decorations\Divider;

//...
public function fields(): array
{
    return [
        //...
        Divider::make(),
        //...
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/divider.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/divider_dark.png') }}"></x-image>

</x-page>
