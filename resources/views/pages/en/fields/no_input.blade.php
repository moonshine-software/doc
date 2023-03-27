<x-page title="NoInput">

<x-p>
    <b>The field is not intended for data entry/modification!</b>
</x-p>

<x-p>
    With this field, you can output text data from any field in the model, or generate text based on the model.
</x-p>

<x-code language="php">
//...
Textarea::make('Review', 'content'), // Ordinary input field

NoInput::make('Review', 'content'), // Print the text of the field ->content from the current model

NoInput::make('Testimonial', 'content',
    fn(Model $item) => sprintf('<div style="background-color: red;">%s</div>'.
        '<div style="background-color: black;">%s</div>',
        $item->content,
        $item->created_at->isoFormat('LL'),
)), // Outputs the generated content
//...
</x-code>

<x-image src="{{ asset('screenshots/no-input.png') }}"></x-image>


</x-page>
