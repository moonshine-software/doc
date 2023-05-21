@props([
    'pattern' => '',
    'prefix' => ''
])

<div class="mb-6">
    <x-moonshine::grid>
        @foreach (glob($pattern) as $filename)
            <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
                <div @click.prevent="navigator.clipboard.writeText('{{ $prefix . basename($filename, ".blade.php") }}')">
                    <x-moonshine::card class="flex flex-col items-center card-copy">
                        <x-moonshine::icon :icon='$prefix . basename($filename, ".blade.php")' size="8"/>
                    </x-moonshine::card>
                </div>
                <small class=" text-xs leading-normal">{{ basename($filename, ".blade.php") }}</small>
            </div>
        @endforeach
    </x-moonshine::grid>
</div>
