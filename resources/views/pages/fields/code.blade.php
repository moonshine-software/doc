<x-page title="Код">

<x-p>Редактор кода</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Code;

//...
public function fields(): array
{
    return [
        Code::make('Код', 'code')
            ->language('js')
            ->lineNumbers()
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/code.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-belongs_to') }}">BelongsTo</x-next>

</x-page>



