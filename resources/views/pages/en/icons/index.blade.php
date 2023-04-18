<x-page title="Icons" :sectionMenu="[
    'Sections' => [
        ['url' => '#system', 'label' => 'System icons'],
        ['url' => '#custom', 'label' => 'Custom icons']
    ]
]">

<x-p>
    For all entities that have the <code>->icon()</code> method,
    you can use one of the proposed icon sets or create your own set
</x-p>

<x-sub-title id="system">System icons</x-sub-title>

<x-code language="php">
    ->icon('add') // [tl! focus]
</x-code>

<x-icon-list
    pattern="../vendor/moonshine/moonshine/resources/views/ui/icons/*.blade.php"
/>

<x-sub-title id="custom">Custom icons</x-sub-title>

<x-p>
    It is also possible to create a blade file with your custom icon. For this you need in <code>resources/views/vendor/moonshine/shared/icons</code>
    create blade file as example my-icon.blade.php with icon display inside (eg svg code)
    and then specify <code>icon('my-icon')</code>
</x-p>

</x-page>
