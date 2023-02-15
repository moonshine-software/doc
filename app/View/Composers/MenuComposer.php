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
                ['url' => route('section', 'resources-form_actions'), 'label' => 'Действия формы'],
                ['url' => route('section', 'resources-query_tags'), 'label' => 'Быстрые фильтры/Теги'],
                ['url' => route('section', 'resources-form_components'), 'label' => 'Компоненты формы'],
                ['url' => route('section', 'resources-table_styles'), 'label' => 'Стили для таблицы'],
                ['url' => route('section', 'resources-changelogs'), 'label' => 'История изменений'],
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

                ['url' => route('section', 'fields-morph_to'), 'label' => 'MorphTo'],
                ['url' => route('section', 'fields-morph_one'), 'label' => 'MorphOne'],
                ['url' => route('section', 'fields-morph_many'), 'label' => 'MorphMany'],
                ['url' => route('section', 'fields-morph_to_many'), 'label' => 'MorphToMany'],

                ['url' => route('section', 'fields-spatie-translatable'), 'label' => 'Spatie\Translatable'],
                ['url' => route('section', 'fields-spatie-medialibrary'), 'label' => 'Spatie\MediaLibrary'],

                ['url' => route('section', 'fields-no_input'), 'label' => 'NoInput'],
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

            'Декорации' => [
                ['url' => route('section', 'decorations-index'), 'label' => 'Основы'],
                ['url' => route('section', 'decorations-tabs'), 'label' => 'Вкладки'],
                ['url' => route('section', 'decorations-heading'), 'label' => 'Заголовок'],
                ['url' => route('section', 'decorations-block'), 'label' => 'Block'],
                ['url' => route('section', 'decorations-flex'), 'label' => 'Flex'],
                ['url' => route('section', 'decorations-button'), 'label' => 'Button'],
                ['url' => route('section', 'decorations-collapse'), 'label' => 'Collapse'],
            ],

            'Метрики' => [
                ['url' => route('section', 'metrics-index'), 'label' => 'Основы'],
                ['url' => route('section', 'metrics-value'), 'label' => 'Значение'],
                ['url' => route('section', 'metrics-line_chart'), 'label' => 'Line Chart'],
            ],

            'Действия' => [
                ['url' => route('section', 'actions-index'), 'label' => 'Основы'],
                ['url' => route('section', 'actions-export'), 'label' => 'Экспорт'],
                ['url' => route('section', 'actions-import'), 'label' => 'Импорт'],
            ],

            'Digging Deeper' => [
                ['url' => route('section', 'advanced-dashboard'), 'label' => 'Dashboard'],
                ['url' => route('section', 'advanced-pages'), 'label' => 'Страницы'],
                ['url' => route('section', 'advanced-menu'), 'label' => 'Меню'],
                ['url' => route('section', 'advanced-authorization'), 'label' => 'Авторизация'],
                ['url' => route('section', 'advanced-events'), 'label' => 'События'],
                ['url' => route('section', 'advanced-notifications'), 'label' => 'Уведомления'],
                ['url' => route('section', 'advanced-socialite'), 'label' => 'Socialite'],
                ['url' => route('section', 'advanced-localization'), 'label' => 'Локализация'],
                ['url' => route('section', 'advanced-extensions'), 'label' => 'Расширения'],
            ],
        ];

        $view->with('menu', $menu);
    }
}
