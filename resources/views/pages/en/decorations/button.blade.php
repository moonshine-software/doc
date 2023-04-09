<x-page title="Button">

<x-p>
    To add a button with a link to a form
</x-p>

<x-code language="php">
use MoonShine\Decorations\Button;

//...
public function fields(): array
{
    return [
        Button::make(
            'Link to article',
            $this->getItem() ? route('articles.show', $this->getItem()) : '/',
            true
        )->icon('clip'),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/button.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/button_dark.png') }}"></x-image>

</x-page>
