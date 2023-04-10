<x-page title="Spatie\Translatable" :sectionMenu="[
    'Разделы' => [
        ['url' => '#fields', 'label' => 'С набором полей'],
        ['url' => '#required', 'label' => 'Обязательные переводы'],
        ['url' => '#priority', 'label' => 'Рекомендуемые переводы'],
    ]
]">

<x-p class="font-bold text-pink">
    Поле вынесено в отдельный пакет, перед использованием необходимо выполнить установку
</x-p>

<x-code language="shell">
    php composer require visual-ideas/moonshine-spatie-translatable
</x-code>

<x-p>
    Поле предназначено для работы с пакетом
    <x-link link="https://github.com/spatie/laravel-translatable" target="_blank">Laravel-translatable</x-link>
    от
    <x-link link="https://spatie.be/open-source" target="_blank">Spatie</x-link>
</x-p>

<x-p>
    Прежде чем использовать поле Spatie\Translatable, необходимо убедиться что:
</x-p>

<x-ul :items="[
'Пакет spatie/laravel-translatable установлен и настроен',
'Поле, передаваемое в Spatie\Translatable, добавлено в массив $translatable модели'
]"></x-ul>

<x-code language="php">
use MoonShine\Fields\Spatie\Translatable;
//...
Translatable::make('Название', 'name')
//...
</x-code>

<x-sub-title id="required">Обязательные переводы</x-sub-title>

<x-p>
    Для указания языков переводов, без которых валидатор не позволит создать/сохранить запись используется
    метод ->requiredLanguages(array $languages).
</x-p>

<x-p>
    Рекомендуется передавать в этот метод значение config('app.fallback_locale')
</x-p>


<x-code language="php">
use MoonShine\Fields\Spatie\Translatable;
//...
Translatable::make('Название', 'name')
    ->requiredLanguages([config('app.fallback_locale'), 'ru'])
//...
</x-code>

<x-sub-title id="priority">Рекомендуемые переводы</x-sub-title>

<x-p>
    При указании данного массива, коды языков в формах добавления/изменения конкретного перевода
    будут идти в начале списка всех возможных языков.
</x-p>

<x-code language="php">
use MoonShine\Fields\Spatie\Translatable;
//...
Translatable::make('Название', 'name')
    ->priorityLanguages([config('app.fallback_locale'), config('app.locale'), 'de', 'fr', 'uk'])
//...
</x-code>

<x-sub-title id="removable">Удаление</x-sub-title>

<x-p>
    Позволяет удалять конкретные переводы из введенных
</x-p>

<x-code language="php">
Translatable::make('Field', 'field')
    ->removable() // [tl! focus]
</x-code>

<x-p>
    Если оставить текст перевода пустым - он будет удален!
</x-p>

<x-p>
    Если в списке переводов будут 2 перевода на один язык, перевод, идущий первым, будет удален (замещён)!
</x-p>

</x-page>



