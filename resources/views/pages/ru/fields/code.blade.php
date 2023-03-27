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

<x-image theme="light" src="{{ asset('screenshots/code.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/code_dark.png') }}"></x-image>

</x-page>



