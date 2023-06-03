<x-page title="Upgrade Guide" :sectionMenu="null">

<x-moonshine::badge color="green">
    Upgrading To 1.50 From 1.0
</x-moonshine::badge>

<x-sub-title>
    registerResources is outdated and will be removed in 2.0 version
</x-sub-title>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuItem::make('Admins', new MoonShineUserResource()),
]);
</x-code>

<x-p>
    We recommend to use the menu method
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('Admins', new MoonShineUserResource()),
]);
</x-code>

<x-sub-title>
    The fullWidth field method is outdated and will be removed
</x-sub-title>

<x-sub-title>
    To create a display grid in a form, you should use the Grid/Column decorations
</x-sub-title>

<x-sub-title>
    Laravel filemanager is excluded from the base package, it should be installed separately
</x-sub-title>
</x-page>
