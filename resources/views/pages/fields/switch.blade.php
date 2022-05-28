<x-page title="Переключатель">

<x-code language="php">
use Leeto\MoonShine\Fields\SwitchBoolean;

//...
public function fields(): array
{
    return [
        SwitchBoolean::make('Опубликовать', 'active')
    ];
}

//...
</x-code>

<x-code language="php">
use Leeto\MoonShine\Fields\SwitchBoolean;

//...
public function fields(): array
{
    return [
        SwitchBoolean::make('Опубликовать', 'active')
            ->onValue(1) // Активное значение элемента формы
            ->offValue(0) // Неактивное значение элемента формы
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/switch.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-wysiwyg') }}">WYSIWYG</x-next>

</x-page>



