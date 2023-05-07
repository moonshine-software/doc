<?php

return [
    'Getting started:play' => [
        ['slug' => 'concept', 'label' => 'Conception'],
        ['slug' => 'installation', 'label' => 'Installation'],
        ['slug' => 'configuration', 'label' => 'Configuration', 'badge' => 'new'],
        ['slug' => 'contribution', 'label' => 'Contribution Guide'],
        ['slug' => 'releases', 'label' => 'Releases'],
        ['slug' => 'upgrade_guide', 'label' => 'Upgrade guide', 'badge' => 'new'],
    ],

    'Resources:document-duplicate' => [
        ['slug' => 'resources-index', 'label' => 'Basic'],
        ['slug' => 'resources-fields', 'label' => 'Fields'],
        ['slug' => 'resources-filters', 'label' => 'Filters'],
        ['slug' => 'resources-actions', 'label' => 'Actions'],
        ['slug' => 'resources-active_actions', 'label' => 'Active actions'],
        ['slug' => 'resources-validation', 'label' => 'Validation rules'],
        ['slug' => 'resources-search', 'label' => 'Search'],
        ['slug' => 'resources-scopes', 'label' => 'Scopes'],
        ['slug' => 'resources-metrics', 'label' => 'Metrics'],
        ['slug' => 'resources-item_actions', 'label' => 'Item actions'],
        ['slug' => 'resources-bulk_actions', 'label' => 'Bulk actions'],
        ['slug' => 'resources-form_actions', 'label' => 'Form actions'],
        ['slug' => 'resources-query_tags', 'label' => 'Query filters/tags'],
        ['slug' => 'resources-form_components', 'label' => 'Form components'],
        ['slug' => 'resources-table_styles', 'label' => 'Table styles'],
        ['slug' => 'resources-changelogs', 'label' => 'Changelog'],
        ['slug' => 'resources-singleton', 'label' => 'SingletonResource'],
    ],

    'Fields:bars-3' => [
        ['slug' => 'fields-index', 'label' => 'Basic'],
        // Text
        ['slug' => 'fields-text', 'label' => 'Text'],
        ['slug' => 'fields-id', 'label' => 'ID'],
        ['slug' => 'fields-slug', 'label' => 'Slug'],
        ['slug' => 'fields-color', 'label' => 'Color'],
        ['slug' => 'fields-url', 'label' => 'Url'],
        ['slug' => 'fields-email', 'label' => 'E-mail'],
        ['slug' => 'fields-phone', 'label' => 'Phone'],
        ['slug' => 'fields-password', 'label' => 'Password'],
        ['slug' => 'fields-number', 'label' => 'Number'],
        ['slug' => 'fields-slide', 'label' => 'Slide'],
        ['slug' => 'fields-date', 'label' => 'Date'],


        // Textarea
        ['slug' => 'fields-textarea', 'label' => 'Textarea'],
        ['slug' => 'fields-wysiwyg', 'label' => 'WYSIWYG'],
        ['slug' => 'fields-code', 'label' => 'Code'],

        // Select
        ['slug' => 'fields-select', 'label' => 'Select'],
        ['slug' => 'fields-enum', 'label' => 'Enum'],

        // Checkbox
        ['slug' => 'fields-checkbox', 'label' => 'Checkbox'],
        ['slug' => 'fields-switch', 'label' => 'Switch'],

        // File
        ['slug' => 'fields-file', 'label' => 'File'],
        ['slug' => 'fields-image', 'label' => 'Image'],

        // Table
        ['slug' => 'fields-json', 'label' => 'Json'],

        // Relations
        ['slug' => 'fields-belongs_to', 'label' => 'BelongsTo'],
        ['slug' => 'fields-belongs_to_many', 'label' => 'BelongsToMany'],
        ['slug' => 'fields-has_many', 'label' => 'HasMany'],
        ['slug' => 'fields-has_many_through', 'label' => 'HasManyThrough'],
        ['slug' => 'fields-has_one', 'label' => 'HasOne'],
        ['slug' => 'fields-has_one_through', 'label' => 'HasOneThrough'],

        ['slug' => 'fields-morph_to', 'label' => 'MorphTo'],
        ['slug' => 'fields-morph_one', 'label' => 'MorphOne'],
        ['slug' => 'fields-morph_many', 'label' => 'MorphMany'],
        ['slug' => 'fields-morph_to_many', 'label' => 'MorphToMany'],

        ['slug' => 'fields-no_input', 'label' => 'NoInput'],

        // Packages
        ['slug' => 'fields-spatie-translatable', 'label' => 'Spatie\Translatable'],
        ['slug' => 'fields-spatie-medialibrary', 'label' => 'Spatie\MediaLibrary'],
    ],

    'Filters:adjustments-vertical' => [
        ['slug' => 'filters-index', 'label' => 'Basic'],
        // Text
        ['slug' => 'filters-text', 'label' => 'TextFilter'],
        ['slug' => 'filters-date', 'label' => 'DateFilter'],
        ['slug' => 'filters-date_range', 'label' => 'DateRangeFilter'],
        ['slug' => 'filters-slide', 'label' => 'SlideFilter'],

        // Select
        ['slug' => 'filters-select', 'label' => 'SelectFilter'],

        // Checkbox
        ['slug' => 'filters-switch', 'label' => 'SwitchFilter'],

        ['slug' => 'filters-is_empty', 'label' => 'IsEmptyFilter/IsNotEmptyFilter'],

        // Relations
        ['slug' => 'filters-belongs_to', 'label' => 'BelongsToFilter'],
        ['slug' => 'filters-belongs_to_many', 'label' => 'BelongsToManyFilter'],
        ['slug' => 'filters-has_one', 'label' => 'HasOneFilter'],
    ],

    'Decorations:rocket-launch' => [
        ['slug' => 'decorations-index', 'label' => 'Basic'],
        ['slug' => 'decorations-tabs', 'label' => 'Tabs'],
        ['slug' => 'decorations-heading', 'label' => 'Heading'],
        ['slug' => 'decorations-block', 'label' => 'Block'],
        ['slug' => 'decorations-layout', 'label' => 'Layout', 'badge' => 'new'],
        ['slug' => 'decorations-button', 'label' => 'Button'],
        ['slug' => 'decorations-collapse', 'label' => 'Collapse'],
        ['slug' => 'decorations-divider', 'label' => 'Divider', 'badge' => 'new'],
    ],

    'Metrics:chart-bar' => [
        ['slug' => 'metrics-index', 'label' => 'Basic'],
        ['slug' => 'metrics-value', 'label' => 'Value'],
        ['slug' => 'metrics-line_chart', 'label' => 'Line Chart'],
        ['slug' => 'metrics-donut_chart', 'label' => 'Donut Chart', 'badge' => 'new'],
    ],

    'Actions:hand-raised' => [
        ['slug' => 'actions-index', 'label' => 'Basic'],
        ['slug' => 'actions-export', 'label' => 'Export'],
        ['slug' => 'actions-import', 'label' => 'Import'],
    ],

    'Icons:trophy' => [
        ['slug' => 'icons-index', 'label' => 'Basic'],
        ['slug' => 'icons-heroicons', 'label' => 'Heroicons'],
    ],

    'UI components:code-bracket-square' => [
        ['slug' => 'components-alerts', 'label' => 'Alerts'],
        ['slug' => 'components-badges', 'label' => 'Badges'],
        ['slug' => 'components-icons', 'label' => 'Icons'],
        ['slug' => 'components-thumbnails', 'label' => 'Thumbnails'],
        ['slug' => 'components-link', 'label' => 'Link'],
        ['slug' => 'components-modal', 'label' => 'Modal'],
    ],

    'Digging Deeper:moon' => [
        ['slug' => 'advanced-dashboard', 'label' => 'Dashboard', 'badge' => 'new'],
        ['slug' => 'advanced-pages', 'label' => 'Pages'],
        ['slug' => 'advanced-menu', 'label' => 'Menu'],
        ['slug' => 'advanced-assets', 'label' => 'Assets'],
        ['slug' => 'advanced-authentication', 'label' => 'Authentication'],
        ['slug' => 'advanced-authorization', 'label' => 'Authorization'],
        ['slug' => 'advanced-events', 'label' => 'Events'],
        ['slug' => 'advanced-notifications', 'label' => 'Notifications'],
        ['slug' => 'advanced-socialite', 'label' => 'Socialite'],
        ['slug' => 'advanced-localization', 'label' => 'Localization'],
        ['slug' => 'advanced-extensions', 'label' => 'Extensions'],
    ],
];
