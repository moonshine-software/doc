<x-moonshine::modal :closeOutside="false" title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link>
            Open modal
        </x-moonshine::link>
    </x-slot>
</x-moonshine::modal>
