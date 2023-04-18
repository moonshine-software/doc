@props([
    'pattern' => '',
    'prefix' => ''
])

<div class="mb-6">
    <x-moonshine::grid>
        @foreach (glob($pattern) as $filename)
            <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 space-y-6 text-center text-sm">
                <div
                    class="flex flex-col items-center card w-full rounded-lg"
                    @click.prevent="navigator.clipboard.writeText('{{ $prefix . basename($filename, ".blade.php") }}')"
                >
                    <div class="my-6">
                        <x-moonshine::icon :icon='$prefix . basename($filename, ".blade.php")' size="8"/>
                    </div>
                </div>
                <small>{{ basename($filename, ".blade.php") }}</small>
            </div>
        @endforeach
    </x-moonshine::grid>
</div>
