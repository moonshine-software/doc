<x-page title="Button">

<x-p>
    Для добавления кнопки с ссылкой в форму
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Button;

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

</x-page>
