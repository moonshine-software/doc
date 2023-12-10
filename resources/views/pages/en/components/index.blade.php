<x-page
    title="Moonshine components"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#moonshine-component', 'label' => 'MoonShineComponent'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Components in <strong>MoonShine</strong> are the basis for building an interface.<br />
    The admin panel already implements many components that can be divided into several groups:
    Layouts, Decorations and Metrics.
</x-p>

<x-p>
    <em>Layouts</em> - components are used to create the main blocks of the admin panel:
    Flash, Footer, Header, LayoutBlock, LayoutBuilder, Menu, Profile, Sidebar, TopBar.
</x-p>

<x-p>
    <em>Decorations</em> - components are used to visually design the user interface:
    <x-link link="{{ route('moonshine.page', 'components-decoration_block') }}">Block</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_collapse') }}">Collapse</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_divider') }}">Divider</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_layout') . '#flex' }}">Flex</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_fragment') }}">Fragment</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_layout') . '#grid-column' }}">Grid</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_heading') }}">Heading</x-link>,
    LineBreak,
    <x-link link="{{ route('moonshine.page', 'components-decoration_tabs') }}">Tabs</x-link>,
    TextBlock.
</x-p>

<x-p>
    <em>Metrics</em> - components are used to create information blocks:
    <x-link link="{{ route('moonshine.page', 'components-metric_donut_chart') }}">DonutChartMetric</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-metric_line_chart') }}">LineChartMetric</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-metric_value') }}">ValueMetric</x-link>.
</x-p>

<x-p>
    The <strong>MoonShine</strong> admin panel does not restrict you from using other components,
    which can be implemented using
    <x-link link="https://livewire.laravel.com/docs/quickstart" target="_blank"><em>Livewire</em></x-link>,
    as well as <x-link link="https://laravel.com/docs/10.x/blade#components" target="_blank"><em>Blade</em></x-link>
    components.
</x-p>

<x-sub-title id="moonshine-component">MoonShineComponent</x-sub-title>

<x-p>
    <strong>MoonShine</strong> implements a console command to create a <em>MoonShineComponent</em>,
    which already implements the basic methods for use in the admin panel.
</x-p>

<x-code language="shell">
php artisan moonshine:component
</x-code>

<x-p>
    As a result, the <code>NameComponent</code> class will be created, which is the basis of the new component.<br />
    It is located, by default, in the <code>app/MoonShine/Components</code> directory.<br />
    And also the Blade file for the component in the <code>resources/views/admin/components</code> directory.
</x-p>

<x-moonshine::divider label="Component Methods" />

<x-p>
    The <code>make()</code> method is used to create an instance of a component.
</x-p>

<x-code language="php">
use App\MoonShine\Components\NameComponent; // [tl! focus]

//...

public function components(): array
{
    return [
        NameComponent::make() // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    The <code>viewData()</code> method allows you to pass data to the component template.
</x-p>

<x-code language="php">
namespace App\MoonShine\Components; // [tl! focus]

//...

final class Test extends MoonShineComponent
{
    protected function viewData(): array
    {
        return [];
    }
}

//...
</x-code>

@include('recipes.make-component')
</x-page>
