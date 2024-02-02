<x-page
    title="Moonshine components"
    :sectionMenu="[]"
>

<x-p>
    Components in <strong>MoonShine</strong> are the basis for building an interface.<br />
    Many components have already been implemented in the Admin Panel, which can be divided into several groups:
    Systems, Decorations and Metrics.
</x-p>

<x-p>
    <em>Systems</em> - components are used to create the main blocks of the admin panel:
    <x-link link="{{ to_page('components-system_layout') }}">Layout</x-link>,
    <x-link link="{{ to_page('components-system_flash') }}">Flash</x-link>,
    <x-link link="{{ to_page('components-system_footer') }}">Footer</x-link>,
    <x-link link="{{ to_page('components-system_header') }}">Header</x-link>,
    LayoutBlock, LayoutBuilder, Menu,
    <x-link link="{{ to_page('components-system_profile') }}">Profile</x-link>,
    <x-link link="{{ to_page('components-system_search') }}">Search</x-link>,
    <x-link link="{{ to_page('components-system_sidebar') }}">Sidebar</x-link>,
    <x-link link="{{ to_page('components-system_top_bar') }}">TopBar</x-link>.
</x-p>

<x-p>
    <em>Decorations</em> - components are used for visual design of user interface:
    <x-link link="{{ to_page('components-decoration_block') }}">Block</x-link>,
    <x-link link="{{ to_page('components-decoration_collapse') }}">Collapse</x-link>,
    <x-link link="{{ to_page('components-decoration_divider') }}">Divider</x-link>,
    <x-link link="{{ to_page('components-decoration_layout') . '#flex' }}">Flex</x-link>,
	<x-link link="{{ to_page('components-decoration_flexible_render') . '#FlexibleRender' }}">FlexibleRender</x-link>,
    <x-link link="{{ to_page('components-decoration_fragment') }}">Fragment</x-link>,
    <x-link link="{{ to_page('components-decoration_layout') . '#grid-column' }}">Grid</x-link>,
    <x-link link="{{ to_page('components-decoration_heading') }}">Heading</x-link>,
    LineBreak,
    <x-link link="{{ to_page('components-decoration_modal') }}">Modal</x-link>,
    <x-link link="{{ to_page('components-decoration_offcanvas') }}">Offcanvas</x-link>,
    <x-link link="{{ to_page('components-decoration_tabs') }}">Tabs</x-link>,
    <x-link link="{{ to_page('components-decoration_when') }}">When</x-link>.
</x-p>

<x-p>
    <em>Metrics</em> - components are used to create information blocks:
    <x-link link="{{ to_page('components-metric_donut_chart') }}">DonutChartMetric</x-link>,
    <x-link link="{{ to_page('components-metric_line_chart') }}">LineChartMetric</x-link>,
    <x-link link="{{ to_page('components-metric_value') }}">ValueMetric</x-link>.
</x-p>

<x-p>
    The <strong>MoonShine</strong> admin panel does not restrict you from using other components,
    which can be implemented using
    <x-link link="https://livewire.laravel.com/docs/quickstart" target="_blank"><em>Livewire</em></x-link>,
    as well as <x-link link="https://laravel.com/docs/10.x/blade#components" target="_blank"><em>Blade</em></x-link>
    components.
</x-p>

</x-page>
