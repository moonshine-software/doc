<x-page title="Метрики">

<x-p>
    Блоки для отображения статистики
</x-p>

<x-p>
    Можно вывести на главной странице <x-link link="{{ route('moonshine.page', 'advanced-dashboard') }}">панели управления</x-link>
    и в каждом отдельном <x-link link="{{ route('moonshine.page', 'resources-index') }}">ресурсе</x-link>
</x-p>

<x-p>
    Метрикам также доступны методы декораций
    <x-link link="{{ route('moonshine.page', 'decorations-layout#grid-column') }}">Layout (columnSpan)</x-link>
</x-p>
</x-page>
