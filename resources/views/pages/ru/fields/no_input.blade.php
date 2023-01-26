<x-page title="NoInput">

<x-p>
    <b>Поле не предназначено для ввода/изменения данных!</b>
</x-p>

<x-p>
    С помощью данного поля вы можете вывести текстовые данные из любого поля модели,
    либо сгенерировать текст на основе модели.
</x-p>

<x-code language="php">
//...
Textarea::make('Отзыв', 'content'), // Обычное поле ввода

NoInput::make('Отзыв', 'content'), // Выведет текст поля ->content из текущей модели

NoInput::make('Отзыв', 'content',
    fn(Model $item) => sprintf('<div style="background-color: red;">%s</div>'.
        '<div style="background-color: black;">%s</div>',
        $item->content,
        $item->created_at->isoFormat('LL'),
)), // Выведет сгенерированный контент
//...
</x-code>

<x-image src="{{ asset('screenshots/no-input.png') }}"></x-image>


</x-page>
