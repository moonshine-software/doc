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
    The first argument - page Title
</x-p>

<x-p>
    The second argument - page slug to generate url
</x-p>


<x-p>
    The third argument is your custom blade view, which could be found in the resources/views
</x-p>

<x-p>
    The fourth argument is the data required for view
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    For example, you can add logic using your own routes and controllers
</x-moonshine::alert>
</x-page>
