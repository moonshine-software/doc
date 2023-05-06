<x-moonshine::modal title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link @click.prevent="toggleModal;">
            Open modal
        </x-moonshine::link>
    </x-slot>
</x-moonshine::modal>
