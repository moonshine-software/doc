<x-page
    title="Moonshine компоненты"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#moonshine-component', 'label' => 'MoonShineComponent'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компоненты в <strong>MoonShine</strong> являются основой для построения интерфейса.<br />
    В админ-панели уже реализовано множество компонентов, которые можно разделить на несколько групп:
    Systems, Decorations и Metrics.
</x-p>

<x-p>
    <em>Systems</em> - компоненты используются для создания основных блоков админ-панели:
    <x-link link="{{ route('moonshine.page', 'components-system_layout') }}">Layout</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-system_flash') }}">Flash</x-link>,
    Footer, Header, LayoutBlock, LayoutBuilder, Menu,
    <x-link link="{{ route('moonshine.page', 'components-system_profile') }}">Profile</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-system_sidebar') }}">Sidebar</x-link>,
    TopBar.
</x-p>

<x-p>
    <em>Decorations</em> - компоненты используются для визуального оформления пользовательского интерфейса:
    <x-link link="{{ route('moonshine.page', 'components-decoration_block') }}">Block</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_collapse') }}">Collapse</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_divider') }}">Divider</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_layout') . '#flex' }}">Flex</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_flexible_render') . '#FlexibleRender' }}">FlexibleRender</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_fragment') }}">Fragment</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_layout') . '#grid-column' }}">Grid</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_heading') }}">Heading</x-link>,
    LineBreak,
    <x-link link="{{ route('moonshine.page', 'components-decoration_tabs') }}">Tabs</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-decoration_when') }}">When</x-link>.
</x-p>

<x-p>
    <em>Metrics</em> - компоненты используются для создания информационных блоков:
    <x-link link="{{ route('moonshine.page', 'components-metric_donut_chart') }}">DonutChartMetric</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-metric_line_chart') }}">LineChartMetric</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-metric_value') }}">ValueMetric</x-link>.
</x-p>

<x-p>
    Админ-панель <strong>MoonShine</strong> не ограничивает вас в использовании других компонентов,
    которые могут быть реализованы с использованием
    <x-link link="https://livewire.laravel.com/docs/quickstart" target="_blank"><em>Livewire</em></x-link>,
    а так же <x-link link="https://laravel.com/docs/10.x/blade#components" target="_blank"><em>Blade</em></x-link>
    компоненты.
</x-p>

<x-sub-title id="moonshine-component">MoonShineComponent</x-sub-title>

<x-p>
    В <strong>MoonShine</strong> реализована консольная команда для создания <em>MoonShineComponent</em>,
    в котором уже реализованы основные методы для использования в админ панели.
</x-p>

<x-code language="shell">
php artisan moonshine:component
</x-code>

<x-p>
    В результате будет создан класс <code>NameComponent</code>, который является основой нового компонента.<br />
    Располагается он, по умолчанию, в директории <code>app/MoonShine/Components</code>.<br />
    А так же Blade файл для компонента в директории <code>resources/views/admin/components</code>.
</x-p>

<x-moonshine::divider label="Методы компонента" />

<x-p>
    Метод <code>make()</code> предназначен для создания экземпляра компонента.
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
    Метод <code>viewData()</code> позволяет передать данные в шаблон компонента.
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
