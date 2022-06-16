<x-page title="Метрики">

<x-p>
    Блоки для отображения статистики
</x-p>

<x-p>
    Можно вывести на главной странице <x-link link="{{ route('section', 'dashboard-index') }}">панели управления</x-link>
    и в каждом отдельном <x-link link="{{ route('section', 'resources-index') }}">ресурсе</x-link>
</x-p>

<x-next href="{{ route('section', 'metrics-value') }}">Значение</x-next>
</x-page>
