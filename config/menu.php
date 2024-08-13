<?php

return [
    'Getting started:play' => [
        ['slug' => 'installation', 'label' => 'Installation'],
        ['slug' => 'configuration', 'label' => 'Configuration'],
        ['slug' => 'contribution', 'label' => 'Contribution Guide'],
        ['slug' => 'upgrade_guide', 'label' => 'Upgrade guide'],
        ['slug' => 'support_policy', 'label' => 'Support policy'],
        ['slug' => 'troubleshooting', 'label' => 'Troubleshooting'],
    ],

    ':_divider_',

    'Menu:bars-3' => [
        ['slug' => 'menu', 'label' => 'Menu'],
    ],

    'Appearance:photo' => [
        ['slug' => 'appearance-index', 'label' => 'Basics'],
        ['slug' => 'appearance-layout_builder', 'label' => 'LayoutBuilder'],
        ['slug' => 'appearance-assets', 'label' => 'AssetsManager'],
        ['slug' => 'icons', 'label' => 'Icons'],
    ],

    'Models Resources:document-duplicate' => [
        ['slug' => 'resources-index', 'label' => 'Basics'],
        ['slug' => 'resources-fields', 'label' => 'Fields'],
        ['slug' => 'resources-pages', 'label' => 'With pages'],
        ['slug' => 'resources-table', 'label' => 'Table'],
        ['slug' => 'resources-form', 'label' => 'Form'],
        ['slug' => 'resources-validation', 'label' => 'Validation rules'],
        ['slug' => 'resources-buttons', 'label' => 'Buttons'],
        ['slug' => 'resources-routes', 'label' => 'Routes'],
        ['slug' => 'resources-filters', 'label' => 'Filters'],
        ['slug' => 'resources-search', 'label' => 'Search'],
        ['slug' => 'resources-query', 'label' => 'Query'],
        ['slug' => 'resources-query_tags', 'label' => 'Quick filters (tags)'],
        ['slug' => 'resources-metrics', 'label' => 'Metrics'],
        ['slug' => 'resources-events', 'label' => 'Events'],
        ['slug' => 'resources-import_export', 'label' => 'Import / Export'],
        ['slug' => 'resources-authorization', 'label' => 'Authorization'],
    ],

    'Page:newspaper' => [
        ['slug' => 'page-class', 'label' => 'Create class'],
        ['slug' => 'page-instance', 'label' => 'Make instance'],
    ],

    'Fields:table-cells' => [
        ['slug' => 'fields-index', 'label' => 'Basics'],
        // Text
        'Input:_divider_',
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
        ['slug' => 'fields-markdown', 'label' => 'Markdown'],
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
        ['slug' => 'fields-morph_to', 'label' => 'MorphTo'],
        ['slug' => 'fields-morph_one', 'label' => 'MorphOne'],
        ['slug' => 'fields-morph_many', 'label' => 'MorphMany'],
        ['slug' => 'fields-morph_to_many', 'label' => 'MorphToMany'],

        'Other:_divider_',
        ['slug' => 'fields-hidden_ids', 'label' => 'HiddenIds'],
        ['slug' => 'fields-preview', 'label' => 'Preview'],
        ['slug' => 'fields-position', 'label' => 'Position'],
        ['slug' => 'fields-stack_fields', 'label' => 'StackFields'],
        ['slug' => 'fields-td', 'label' => 'Td', 'badge' => 'new'],
        ['slug' => 'fields-template', 'label' => 'Template'],
    ],

    'Components:rectangle-group' => [
        ['slug' => 'components-index', 'label' => 'Basics'],
        ['slug' => 'components-moonshine_component', 'label' => 'MoonShineComponent'],

        // System
        'System:_divider_',
        ['slug' => 'components-system_layout', 'label' => 'Layout', 'title' => 'System component Layout'],
        ['slug' => 'components-system_flash', 'label' => 'Flash', 'title' => 'System component Flash'],
        ['slug' => 'components-system_footer', 'label' => 'Footer', 'title' => 'System component Footer'],
        ['slug' => 'components-system_header', 'label' => 'Header', 'title' => 'System component Header'],
        ['slug' => 'components-system_profile', 'label' => 'Profile', 'title' => 'System component Profile'],
        ['slug' => 'components-system_search', 'label' => 'Search', 'title' => 'System component Search'],
        ['slug' => 'components-system_sidebar', 'label' => 'Sidebar', 'title' => 'System component Sidebar'],
        ['slug' => 'components-system_top_bar', 'label' => 'TopBar', 'title' => 'System component TopBar'],

        // Decorations
        'Decorations:_divider_',
        ['slug' => 'components-decoration_block', 'label' => 'Block', 'title' => 'Decoration Block'],
        ['slug' => 'components-decoration_collapse', 'label' => 'Collapse', 'title' => 'Decoration Collapse'],
        ['slug' => 'components-decoration_divider', 'label' => 'Divider', 'title' => 'Decoration Divider'],
        ['slug' => 'components-decoration_fragment', 'label' => 'Fragment', 'title' => 'Decoration Fragment'],
        ['slug' => 'components-decoration_flexible_render', 'label' => 'FlexibleRender', 'title' => 'Decoration FlexibleRender'],
        ['slug' => 'components-decoration_heading', 'label' => 'Heading', 'title' => 'Decoration Heading'],
        ['slug' => 'components-decoration_layout', 'label' => 'Layout', 'title' => 'Decoration Layout'],
        ['slug' => 'components-decoration_modal', 'label' => 'Modal', 'title' => 'Decoration Modal'],
        ['slug' => 'components-decoration_offcanvas', 'label' => 'Offcanvas', 'title' => 'Decoration Offcanvas'],
        ['slug' => 'components-decoration_tabs', 'label' => 'Tabs', 'title' => ' Tabs'],
        ['slug' => 'components-decoration_when', 'label' => 'When', 'title' => 'Decoration When'],

        // Metrics
        'Metrics:_divider_',
        ['slug' => 'components-metric_donut_chart', 'label' => 'Donut Chart', 'title' => 'Metric Donut Chart'],
        ['slug' => 'components-metric_line_chart', 'label' => 'Line Chart', 'title' => 'Metric Line Chart'],
        ['slug' => 'components-metric_value', 'label' => 'Value', 'title' => 'Metric Value'],

        // UI components
        'UI:_divider_',
        ['slug' => 'components-badge', 'label' => 'Badge', 'title' => 'Badge Component'],
        ['slug' => 'components-dropdown', 'label' => 'Dropdown', 'title' => 'Dropdown Component'],
        ['slug' => 'components-card', 'label' => 'Card', 'title' => 'Card Component'],
        ['slug' => 'components-carousel', 'label' => 'Carousel', 'title' => 'Carousel Component'],
        ['slug' => 'components-link', 'label' => 'Link', 'title' => 'Link Component'],
    ],

    'ActionButton:cursor-arrow-ripple' => [
        ['slug' => 'action_button', 'label' => 'ActionButton'],
    ],

    'UI components:code-bracket-square' => [
        ['slug' => 'ui-index', 'label' => 'Basics'],
        ['slug' => 'ui-alert', 'label' => 'Alert'],
        ['slug' => 'ui-badge', 'label' => 'Badge'],
        ['slug' => 'ui-boolean', 'label' => 'Boolean'],
        ['slug' => 'ui-box', 'label' => 'Box'],
        ['slug' => 'ui-breadcrumbs', 'label' => 'Breadcrumbs'],
        ['slug' => 'ui-card', 'label' => 'Card'],
        ['slug' => 'ui-carousel', 'label' => 'Carousel'],
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

    'Advanced:moon' => [
        //['slug' => 'advanced-resource', 'label' => 'Resource'],
        //['slug' => 'advanced-development', 'label' => 'Development'],
        ['slug' => 'advanced-commands', 'label' => 'Commands'],
        ['slug' => 'advanced-controller', 'label' => 'Controllers'],
        ['slug' => 'advanced-form_builder', 'label' => 'FormBuilder'],
        ['slug' => 'advanced-table_builder', 'label' => 'TableBuilder'],
        ['slug' => 'advanced-cards_builder', 'label' => 'CardsBuilder'],
        ['slug' => 'advanced-type_casts', 'label' => 'TypeCasts'],
        ['slug' => 'advanced-js_events', 'label' => 'Js events'],
        ['slug' => 'advanced-helpers', 'label' => 'Helpers'],
        ['slug' => 'advanced-authentication', 'label' => 'Authentication'],
        ['slug' => 'advanced-authorization', 'label' => 'Authorization'],
        ['slug' => 'advanced-notifications', 'label' => 'Notifications'],
        ['slug' => 'advanced-socialite', 'label' => 'Socialite'],
        ['slug' => 'advanced-localization', 'label' => 'Localization'],
        ['slug' => 'advanced-testings', 'label' => 'Testing'],
        ['slug' => 'advanced-development', 'label' => 'Package development'],
    ],

    ':_divider_',
    'Recipes:book-open' => [
        ['slug' => 'recipes', 'label' => 'Recipes'],
    ],

    ':_divider_',
    'Packages:cube' => [
        ['slug' => 'packages', 'label' => 'Packages', 'badge' => 'new'],
    ],
];
