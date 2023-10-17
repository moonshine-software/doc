<x-moonshine::modal
    async
    :asyncUrl="route('async')"
    title="Title"
>
    <x-slot name="outerHtml">
        <x-moonshine::link>
            Open async modal
        </x-moonshine::link>
    </x-slot>
</x-moonshine::modal>
