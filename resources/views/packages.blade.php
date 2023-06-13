<div x-data="{active: null}">
    @foreach(collect(config('packages', []))->keyBy('category') as $package)
        <x-moonshine::link
            x-bind:class="active === '{{ $package['category'] }}' ? 'btn-primary' : ''"
            @click.prevent="active = active === '{{ $package['category'] }}' ? null : '{{ $package['category'] }}'">
            {{ $package['category'] }}
        </x-moonshine::link>
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
                                   :title="$package['title']"
                                   @click.prevent="toggleModal;"
                >
                    <x-slot:header>
                        <x-moonshine::badge color="green">
                            {{ $package['category'] }}
                        </x-moonshine::badge>

                        <x-moonshine::badge color="purple">
                            {{ $package['owner'] }}
                        </x-moonshine::badge>

                        <hr class="divider" />
                    </x-slot:header>

                    <x-package-info-modal
                        :title="$package['title']"
                        :route="route('packages', ['package' => $package['slug']])"
                    />
                </x-moonshine::card>
            </x-moonshine::column>
        @endforeach
    </x-moonshine::grid>
</div>
