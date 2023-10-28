<?php

return [
    'Getting started:play' => [
        ['slug' => 'concept', 'label' => 'Concept'],
        ['slug' => 'installation', 'label' => 'Installation'],
        ['slug' => 'configuration', 'label' => 'Configuration'],
        ['slug' => 'contribution', 'label' => 'Contribution Guide'],
        ['slug' => 'releases', 'label' => 'Releases'],
        ['slug' => 'upgrade_guide', 'label' => 'Upgrade guide'],
        ['slug' => 'support_policy', 'label' => 'Support policy'],
        ['slug' => 'troubleshooting', 'label' => 'Troubleshooting'],
    ],

    ':_divider_',

    'Page:newspaper' => [
        ['slug' => 'page-class', 'label' => 'Create class'],
        ['slug' => 'page-instance', 'label' => 'Make instance'],
    ],

    'Components:rectangle-group' => [
        ['slug' => 'components-index', 'label' => 'Basics'],

        // Decorations
        'Decorations:_divider_',
        ['slug' => 'components-decorations_tabs', 'label' => 'Tabs'],
        ['slug' => 'components-decorations_heading', 'label' => 'Heading'],
        ['slug' => 'components-decorations_block', 'label' => 'Block'],
        ['slug' => 'components-decorations_layout', 'label' => 'Layout'],
        ['slug' => 'components-decorations_collapse', 'label' => 'Collapse'],
        ['slug' => 'components-decorations_divider', 'label' => 'Divider'],

        // Metrics
        'Metrics:_divider_',
        ['slug' => 'components-metrics_value', 'label' => 'Value'],
        ['slug' => 'components-metrics_line_chart', 'label' => 'Line Chart'],
        ['slug' => 'components-metrics_donut_chart', 'label' => 'Donut Chart'],
    ],

    'Appearance:photo' => [
        ['slug' => 'appearance-index', 'label' => 'Basics'],
        ['slug' => 'appearance-layout_builder', 'label' => 'LayoutBuilder'],
        ['slug' => 'appearance-assets', 'label' => 'AssetsManager'],
        ['slug' => 'appearance-icons', 'label' => 'Icons'],
    ],

    'Models Resources:document-duplicate' => [
        ['slug' => 'resources-index', 'label' => 'Basics'],
        ['slug' => 'resources-fields', 'label' => 'Fields'],
        ['slug' => 'resources-pages', 'label' => 'With pages'],
        ['slug' => 'resources-validation', 'label' => 'Validation rules'],
        ['slug' => 'resources-filters', 'label' => 'Filters'],
        ['slug' => 'resources-search', 'label' => 'Search'],
        ['slug' => 'resources-table_attributes', 'label' => 'Table attributes'],
        ['slug' => 'resources-query', 'label' => 'Query'],
        ['slug' => 'resources-query_tags', 'label' => 'Quick filters (tags)'],
        ['slug' => 'resources-metrics', 'label' => 'Metrics'],
        ['slug' => 'resources-events', 'label' => 'Events'],
        ['slug' => 'resources-authorization', 'label' => 'Authorization'],

//        ['slug' => 'resources-export', 'label' => 'Export'],
//        ['slug' => 'resources-import', 'label' => 'Import'],

//        ['slug' => 'resources-actions', 'label' => 'Actions'],
//        ['slug' => 'resources-active_actions', 'label' => 'Active actions'],
//        ['slug' => 'resources-item_actions', 'label' => 'Item actions'],
//        ['slug' => 'resources-bulk_actions', 'label' => 'Bulk actions'],
//        ['slug' => 'resources-form_actions', 'label' => 'Form actions'],
//        ['slug' => 'resources-components', 'label' => 'Components'],
//        ['slug' => 'resources-singleton', 'label' => 'SingletonResource'],
    ],

    'Menu:bars-3' => [
        ['slug' => 'menu', 'label' => 'Menu'],
    ],

    'Fields:table-cells' => [
        ['slug' => 'fields-index', 'label' => 'Basics'],
        // Text
        'Text:_divider_',
        ['slug' => 'fields-text', 'label' => 'Text'],
        ['slug' => 'fields-hidden', 'label' => 'Hidden'],
        ['slug' => 'fields-id', 'label' => 'ID'],
        ['slug' => 'fields-slug', 'label' => 'Slug'],
        ['slug' => 'fields-color', 'label' => 'Color'],
        ['slug' => 'fields-url', 'label' => 'Url'],
        ['slug' => 'fields-email', 'label' => 'E-mail'],
        ['slug' => 'fields-phone', 'label' => 'Phone'],
        ['slug' => 'fields-password', 'label' => 'Password'],
        ['slug' => 'fields-number', 'label' => 'Number'],
        ['slug' => 'fields-range', 'label' => 'Range'],
        ['slug' => 'fields-range_slider', 'label' => 'RangeSlider'],
        ['slug' => 'fields-date', 'label' => 'Date'],
        ['slug' => 'fields-date_range', 'label' => 'DateRange'],

        // Textarea
        'Textarea:_divider_',
        ['slug' => 'fields-textarea', 'label' => 'Textarea'],
        ['slug' => 'fields-code', 'label' => 'Code'],
        ['slug' => 'fields-tinymce', 'label' => 'TinyMce'],

        // Select
        'Select:_divider_',
        ['slug' => 'fields-select', 'label' => 'Select'],
        ['slug' => 'fields-enum', 'label' => 'Enum'],

        // Checkbox
        'Checkbox:_divider_',
        ['slug' => 'fields-checkbox', 'label' => 'Checkbox'],
        ['slug' => 'fields-switcher', 'label' => 'Switcher'],

        // File
        'File:_divider_',
        ['slug' => 'fields-file', 'label' => 'File'],
        ['slug' => 'fields-image', 'label' => 'Image'],

        // Json
        'Json:_divider_',
        ['slug' => 'fields-json', 'label' => 'Json'],

        // Relationships
        'Relationships:_divider_',
        ['slug' => 'fields-belongs_to', 'label' => 'BelongsTo'],
        ['slug' => 'fields-belongs_to_many', 'label' => 'BelongsToMany'],
        ['slug' => 'fields-has_many', 'label' => 'HasMany'],
        ['slug' => 'fields-has_many_through', 'label' => 'HasManyThrough'],
        ['slug' => 'fields-has_one', 'label' => 'HasOne'],
        ['slug' => 'fields-has_one_through', 'label' => 'HasOneThrough'],

//        ['slug' => 'fields-morph_to', 'label' => 'MorphTo'],
//        ['slug' => 'fields-morph_one', 'label' => 'MorphOne'],
//        ['slug' => 'fields-morph_many', 'label' => 'MorphMany'],
//        ['slug' => 'fields-morph_to_many', 'label' => 'MorphToMany'],

//        'Other:_divider_',
//        ['slug' => 'fields-no_input', 'label' => 'NoInput'],
//        ['slug' => 'fields-stack_fields', 'label' => 'StackFields'],

       // Packages
//        'Packages:_divider_',
//        ['slug' => 'fields-spatie-translatable', 'label' => 'Spatie\Translatable'],
//        ['slug' => 'fields-spatie-medialibrary', 'label' => 'Spatie\MediaLibrary'],
    ],

    'ActionButton:cursor-arrow-ripple' => [
        ['slug' => 'action_button', 'label' => 'ActionButton'],
    ],

    'Advanced:moon' => [
        ['slug' => 'advanced-resource', 'label' => 'Resource'],
        ['slug' => 'advanced-controller', 'label' => 'Controllers'],
        ['slug' => 'advanced-form_builder', 'label' => 'FormBuilder'],
        ['slug' => 'advanced-table_builder', 'label' => 'TableBuilder'],
        ['slug' => 'advanced-type_casts', 'label' => 'TypeCasts'],
        ['slug' => 'advanced-helpers', 'label' => 'Helpers'],
        ['slug' => 'advanced-authorization', 'label' => 'Authorization'],
        ['slug' => 'advanced-authentication', 'label' => 'Authentication'],
        ['slug' => 'advanced-notifications', 'label' => 'Notifications'],
        ['slug' => 'advanced-socialite', 'label' => 'Socialite'],
        ['slug' => 'advanced-localization', 'label' => 'Localization'],
//        ['slug' => 'advanced-dashboard', 'label' => 'Dashboard', 'badge' => 'new'],
//        ['slug' => 'advanced-routes', 'label' => 'Routes'],
//        ['slug' => 'advanced-development', 'label' => 'Development'],
    ],

    ':_divider_',
    'UI components:code-bracket-square' => [
        ['slug' => 'ui-index', 'label' => 'Basics'],
        ['slug' => 'ui-alert', 'label' => 'Alert'],
        ['slug' => 'ui-badge', 'label' => 'Badge'],
        ['slug' => 'ui-boolean', 'label' => 'Boolean'],
        ['slug' => 'ui-box', 'label' => 'Box'],
        ['slug' => 'ui-breadcrumbs', 'label' => 'Breadcrumbs'],
        ['slug' => 'ui-card', 'label' => 'Card'],
        ['slug' => 'ui-collapse', 'label' => 'Collapse'],
        ['slug' => 'ui-divider', 'label' => 'Divider'],
        ['slug' => 'ui-dropdown', 'label' => 'Dropdown'],
        ['slug' => 'ui-icon', 'label' => 'Icon'],
        ['slug' => 'ui-files', 'label' => 'Files'],
        ['slug' => 'ui-form', 'label' => 'Form elements'],
        ['slug' => 'ui-grid', 'label' => 'Grid/Column'],
        ['slug' => 'ui-link', 'label' => 'Link'],
        ['slug' => 'ui-loader', 'label' => 'Loader'],
        ['slug' => 'ui-modal', 'label' => 'Modal'],
        ['slug' => 'ui-offcanvas', 'label' => 'Offcanvas'],
        ['slug' => 'ui-paginations', 'label' => 'Paginations'],
        ['slug' => 'ui-popover', 'label' => 'Popover'],
        ['slug' => 'ui-progress_bar', 'label' => 'Progress bar'],
        ['slug' => 'ui-rating', 'label' => 'Rating'],
        ['slug' => 'ui-spinner', 'label' => 'Spinner'],
        ['slug' => 'ui-table', 'label' => 'Table'],
        ['slug' => 'ui-tabs', 'label' => 'Tabs'],
        ['slug' => 'ui-thumbnail', 'label' => 'Thumbnail'],
        ['slug' => 'ui-title', 'label' => 'Title'],
        ['slug' => 'ui-toast', 'label' => 'Toast'],
        ['slug' => 'ui-tooltip', 'label' => 'Tooltip'],
    ],

//    ':_divider_',
//    'Packages:cube' => [
//        ['slug' => 'packages', 'label' => 'Packages', 'badge' => 'new'],
//    ],
];
