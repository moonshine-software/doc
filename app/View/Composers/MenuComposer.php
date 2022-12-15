<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu = [
            'Getting started' => [
                ['url' => route('section', 'concept'), 'label' => 'Концепция'],
                ['url' => route('section', 'installation'), 'label' => 'Установка'],
                ['url' => route('section', 'contribution'), 'label' => 'Contribution Guide'],
                ['url' => route('section', 'releases'), 'label' => 'Обновления'],
            ],

            'Разделы' => [
                ['url' => route('section', 'resources-index'), 'label' => 'Основы'],
                ['url' => route('section', 'resources-fields'), 'label' => 'Поля'],
                ['url' => route('section', 'resources-filters'), 'label' => 'Фильтры'],
                ['url' => route('section', 'resources-actions'), 'label' => 'Действия'],
                ['url' => route('section', 'resources-active_actions'), 'label' => 'Доступные разделы'],
                ['url' => route('section', 'resources-validation'), 'label' => 'Валидация'],
                ['url' => route('section', 'resources-search'), 'label' => 'Поиск'],
                ['url' => route('section', 'resources-scopes'), 'label' => 'Scopes'],
                ['url' => route('section', 'resources-metrics'), 'label' => 'Метрики'],
                ['url' => route('section', 'resources-item_actions'), 'label' => 'Кастомные действия'],
                ['url' => route('section', 'resources-bulk_actions'), 'label' => 'Массовые действия'],
                ['url' => route('section', 'resources-table_styles'), 'label' => 'Стили для таблицы'],
            ],

            'Страницы' => [
                ['url' => route('section', 'pages-index'), 'label' => 'Основы'],
            ],

            'Меню' => [
                ['url' => route('section', 'menu-index'), 'label' => 'Основы'],
            ],

            'Поля' => [
                ['url' => route('section', 'fields-index'), 'label' => 'Основы'],
                ['url' => route('section', 'fields-id'), 'label' => 'ID'],
                ['url' => route('section', 'fields-text'), 'label' => 'Текстовое поле'],
                ['url' => route('section', 'fields-select'), 'label' => 'Select'],
                ['url' => route('section', 'fields-enum'), 'label' => 'Enum'],
                ['url' => route('section', 'fields-checkbox'), 'label' => 'Checkbox'],
                ['url' => route('section', 'fields-textarea'), 'label' => 'Textarea'],

                ['url' => route('section', 'fields-image'), 'label' => 'Изображение'],
                ['url' => route('section', 'fields-file'), 'label' => 'Файл'],

                ['url' => route('section', 'fields-json'), 'label' => 'Json'],

                ['url' => route('section', 'fields-color'), 'label' => 'Цвет'],
                ['url' => route('section', 'fields-url'), 'label' => 'Url'],
                ['url' => route('section', 'fields-email'), 'label' => 'E-mail'],
                ['url' => route('section', 'fields-phone'), 'label' => 'Телефон'],

                ['url' => route('section', 'fields-password'), 'label' => 'Пароль'],

                ['url' => route('section', 'fields-number'), 'label' => 'Число'],

                ['url' => route('section', 'fields-slide'), 'label' => 'Диапазон'],

                ['url' => route('section', 'fields-date'), 'label' => 'Дата'],

                ['url' => route('section', 'fields-switch'), 'label' => 'Переключатель'],

                ['url' => route('section', 'fields-wysiwyg'), 'label' => 'WYSIWYG'],
                ['url' => route('section', 'fields-code'), 'label' => 'Код'],

                ['url' => route('section', 'fields-belongs_to'), 'label' => 'BelongsTo'],
                ['url' => route('section', 'fields-belongs_to_many'), 'label' => 'BelongsToMany'],
                ['url' => route('section', 'fields-has_many'), 'label' => 'HasMany'],
                ['url' => route('section', 'fields-has_many_through'), 'label' => 'HasManyThrough'],
                ['url' => route('section', 'fields-has_one'), 'label' => 'HasOne'],
                ['url' => route('section', 'fields-has_one_through'), 'label' => 'HasOneThrough'],
                ['url' => route('section', 'fields-morph_many'), 'label' => 'MorphMany'],
                ['url' => route('section', 'fields-morph_one'), 'label' => 'MorphOne'],

                ['url' => route('section', 'fields-spatie-translatable'), 'label' => 'Spatie\Translatable'],
            ],

            'Декорации' => [
                ['url' => route('section', 'decorations-index'), 'label' => 'Основы'],
                ['url' => route('section', 'decorations-tab'), 'label' => 'Вкладки'],
                ['url' => route('section', 'decorations-heading'), 'label' => 'Заголовок'],
            ],

            'Фильтры' => [
                ['url' => route('section', 'filters-index'), 'label' => 'Основы'],
                ['url' => route('section', 'filters-text'), 'label' => 'Текстовое поле'],
                ['url' => route('section', 'filters-select'), 'label' => 'Селект'],
                ['url' => route('section', 'filters-date'), 'label' => 'Дата'],
                ['url' => route('section', 'filters-date_range'), 'label' => 'Период дат'],
                ['url' => route('section', 'filters-slide'), 'label' => 'Ползунок'],
                ['url' => route('section', 'filters-switch'), 'label' => 'Переключатель'],
                ['url' => route('section', 'filters-is_empty'), 'label' => 'IsEmpty/IsNotEmpty'],
                ['url' => route('section', 'filters-belongs_to'), 'label' => 'BelongsTo'],
                ['url' => route('section', 'filters-belongs_to_many'), 'label' => 'BelongsToMany'],
                ['url' => route('section', 'filters-has_one'), 'label' => 'HasOne'],
            ],

            'Метрики' => [
                ['url' => route('section', 'metrics-index'), 'label' => 'Основы'],
                ['url' => route('section', 'metrics-value'), 'label' => 'Значение'],
                ['url' => route('section', 'metrics-line_chart'), 'label' => 'Line Chart'],
            ],

            'Dashboard' => [
                ['url' => route('section', 'dashboard-index'), 'label' => 'Основы'],
            ],

            'Действия' => [
                ['url' => route('section', 'actions-index'), 'label' => 'Основы'],
                ['url' => route('section', 'actions-export'), 'label' => 'Экспорт'],
            ],

            'Авторизация' => [
                ['url' => route('section', 'authorization-index'), 'label' => 'Основы'],
            ],

            'События' => [
                ['url' => route('section', 'events-index'), 'label' => 'Основы'],
            ],

            'Локализация' => [
                ['url' => route('section', 'localization-index'), 'label' => 'Основы'],
            ],

            'Расширения' => [
                ['url' => route('section', 'extensions-index'), 'label' => 'Основы'],
            ],
        ];

        $view->with('menu', $menu);
    }
}
