<x-page title="Pages" :sectionMenu="$sectionMenu ?? null">

<x-p>
    You can create your own blank pages based on blade view, stylize in your own way and interact
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    CustomPage::make('Page title', 'slug', 'view', fn() => [])
]);
</x-code>

<x-p>
    The first argument - Title pages
</x-p>

<x-p>
    The second argument - slug pages to form url
</x-p>


<x-p>
    The third argument is your custom blade view, which is located in the resources/views
</x-p>

<x-p>
    The fourth argument is the data needed to view
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    As an example using your own routes and controllers to add logic
</x-moonshine::alert>
</x-page>
