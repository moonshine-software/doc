<x-page
    title="Moonshine компоненты"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#moonshine-component', 'label' => 'MoonshineComponent'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компоненты в <strong>MoonShine</strong> являются основой для построения интерфейса.<br />
    В админ-панели уже реализовано множество компонентов, которые можно разделить на несколько групп:
    Layouts, Decorations и Metrics.
</x-p>

<x-p>
    <em>Layouts</em> - компоненты используются для создания основных блоков админ-панели:
    Flash, Footer, Header, LayoutBlock, LayoutBuilder, Menu, Profile, Sidebar, TopBar.
</x-p>

<x-p>
    <em>Decorations</em> - компоненты используются для визуального оформления пользовательского интерфейса:
    Block, Collapse, Divider, Flex, Fragment, Grid, Heading, LineBreak, Tabs, TextBlock.
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

<x-sub-title id="moonshine-component">MoonshineComponent</x-sub-title>

<x-p>
    В <strong>MoonShine</strong> реализована консольная команда для создания <em>MoonshineComponent</em>,
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

final class Test extends MoonshineComponent
{
    protected function viewData(): array
    {
        return [];
    }
}

//...
</x-code>

</x-page>
