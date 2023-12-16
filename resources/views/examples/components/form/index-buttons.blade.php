<x-moonshine::form>
    <x-moonshine::form.input
        name="title"
        placeholder="Title"
        value=""
    />
    <x-slot:buttons><!-- [tl! focus:start] -->
        <x-moonshine::form.button type="reset">Cancel</x-moonshine::form.button>
        <x-moonshine::form.button class="btn-primary">Submit</x-moonshine::form.button>
    </x-slot:buttons><!-- [tl! focus:end] -->
</x-moonshine::form>
