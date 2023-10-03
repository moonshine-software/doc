<x-page title="Code">

<x-extendby :href="route('moonshine.page', 'fields-textarea')">
    Textarea
</x-extendby>

<x-p>Code Editor</x-p>

<x-code language="php">
use MoonShine\Fields\Code;

//...
public function fields(): array
{
    return [
        Code::make('Code', 'code')
            ->language('js')
            ->lineNumbers()
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/code.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/code_dark.png') }}"></x-image>

</x-page>



