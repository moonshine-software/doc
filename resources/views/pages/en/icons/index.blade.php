<x-page title="Icons" :sectionMenu="[
    'Sections' => [
        ['url' => '#system', 'label' => 'System icons'],
        ['url' => '#custom', 'label' => 'Custom icons']
    ]
]">

<x-p>
    For all entities that have the <code>icon()</code> method,
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
    You can also create a blade file with your custom icon. To do this you have to create a blade file in
    <code>resources/views/vendor/moonshine/shared/icons</code> (e.g. - my-icon.blade.php) containing the icon image inside (e.g. svg code)
    and then specify the <code>icon('my-icon')</code>
</x-p>

</x-page>
