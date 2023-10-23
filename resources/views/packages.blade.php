<div x-data="{active: null}">
    @foreach(collect(config('packages', []))->keyBy('category') as $package)
        <x-moonshine::link-button
            x-bind:class="active === '{{ $package['category'] }}' ? 'btn-primary' : ''"
            @click.prevent="active = active === '{{ $package['category'] }}' ? null : '{{ $package['category'] }}'">
            {{ $package['category'] }}
        </x-moonshine::link-button>
    @endforeach

    <hr class="divider" />

    <x-moonshine::grid>
        @foreach(config('packages', []) as $package)
            <x-moonshine::column
                adaptiveColSpan="12"
                colSpan="4"
                x-show="active === null || active === '{{ $package['category'] }}'"
            >
                <x-moonshine::card class="mt-4"
                                   :url="'https://github.com/' . $package['url']"
                                   :title="$package['title']"
                >
                    <x-slot:header>
                        <x-moonshine::badge color="green">
                            {{ $package['category'] }}
                        </x-moonshine::badge>

                        <x-moonshine::badge color="purple">
                            {{ str($package['url'])->before('/') }}
                        </x-moonshine::badge>

                        <hr class="divider" />
                    </x-slot:header>
                </x-moonshine::card>
            </x-moonshine::column>
        @endforeach
    </x-moonshine::grid>
</div>
