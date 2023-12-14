<x-recipe id="form-with-events" title="{{ $title ?? 'Recipe' }}">

<x-p>
    Upon a successful request, the form updates the table and resets the values.
</x-p>

<x-code language="php">
Block::make([
    FormBuilder::make(route('form-table.store'))
    ->fields([
        Text::make('Title')
    ])
    ->name('main-form')
    ->async(asyncEvents: ['table-updated-main-table','form-reset-main-form'])
]),

TableBuilder::make()
    ->fields([
        ID::make(),
        Text::make('Title'),
        Textarea::make('Body'),
    ])
    ->creatable()
    ->items(Post::query()->paginate())
    ->name('main-table')
    ->async()
</x-code>

<x-p>
    Let's also look at how to add your own events
</x-p>

<x-code language="html">
<div x-data=""
     @my-event.window="alert()"
>
</div>
</x-code>

<x-code language="html">
<div x-data="my"
     @my-event.window="asyncRequest"
>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("my", () => ({
            init() {

            },
            asyncRequest() {
                this.$event.preventDefault()

                // this.$el
                // this.$root
            }
        }))
    })
</script>
</x-code>

<x-code language="php">
FormBuilder::make(route('form-table.store'))
    ->fields([
        Text::make('Title')
    ])
    ->name('main-form')
    ->async(asyncEvents: ['my-event'])
</x-code>

</x-recipe>
