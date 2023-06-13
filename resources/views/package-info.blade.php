<x-moonshine::grid>
    <x-moonshine::column
        adaptiveColSpan="12"
        colSpan="8"
    >
        <div class="markdown-body">{!! $readme !!}</div>
    </x-moonshine::column>

    <x-moonshine::column
        adaptiveColSpan="12"
        colSpan="4"
    >
        <x-moonshine::box>
            @if($packageInfo->getPackage())
                <x-code>
                    composer require {{ $packageInfo->getPackage() }}
                </x-code>
            @endif
            <x-moonshine::grid>
                <x-moonshine::column
                    adaptiveColSpan="6"
                    colSpan="6"
                >
                    <x-moonshine::link href="{{ $packageInfo->getRepoUrl() }}" class="block text-center" target="_blank">GitHub</x-moonshine::link>
                </x-moonshine::column>
                @if($packageInfo->getDistUrl())
                    <x-moonshine::column
                        adaptiveColSpan="6"
                        colSpan="6"
                    >
                        <x-moonshine::link href="{{ $packageInfo->getDistUrl() }}" class="block text-center">Download zip</x-moonshine::link>
                    </x-moonshine::column>
                @endisset
            </x-moonshine::grid>
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>
