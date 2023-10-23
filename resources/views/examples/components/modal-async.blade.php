<x-moonshine::modal
    async
    :asyncUrl="route('async')"
    title="Title"
>
    <x-slot name="outerHtml">
        <x-moonshine::link-button>
            Open async modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
