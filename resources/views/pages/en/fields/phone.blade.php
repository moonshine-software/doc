<x-page title="Phone">

<x-p>
    Everything is the same as the "Text Box", only the input type = tel
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Phone;

Phone::make('Phone', 'tel')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">To mask the phone, use the method mask('7 999 999-99-99')</x-moonshine::alert>

</x-page>



