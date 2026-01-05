# Select

- [Basics](#basics)
- [Basic Methods](#basic-methods)
  - [Default value](#default)
  - [Nullable](#nullable)
  - [Placeholder](#placeholder)
- [Groups](#groups)
- [Multiple values selection](#multiple)
- [Search](#search)
- [Asynchronous search](#async)
- [Change events](#on-change-event)
- [Editing in preview mode](#update-on-preview)
- [Values with images](#with-image)
- [Options](#options)
- [Option attributes](#option-attributes)
- [Native display mode](#native)
- [Plugins](#plugins)
- [Custom settings](#settings)
  - [Name settings](#fields-names)
  - [Add. async settings](#async-settings)
  - [Creating new options](#select-creatable)
  - [Max select option](#select-max-items)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Country">
    <x-moonshine::form.select>
        <x-slot:options>
            <option value="1">Option 1</option>
            <option selected value="2">Option 2</option>
        </x-slot:options>
    </x-moonshine::form.select>
</x-moonshine::form.wrapper>
```
~~~

@preview('fields.select')

<a name="basic-methods"></a>
## Basic Methods

<a name="default"></a>
### Default value

If you need to specify a default value, you can use the `default()` method.

```php
default(mixed $default)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->default('value 2')
```

You can also specify options via the `Options` object.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\Support\DTOs\Select\Option;
use MoonShine\Support\DTOs\Select\OptionProperty;
use MoonShine\Support\DTOs\Select\Options;
use MoonShine\UI\Fields\Select;

Select::make('Select')
    ->options(
        new Options([
            new Option(
                label: 'Option 1',
                value: '1',
                selected: true,
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
            new Option(
                label: 'Option 2',
                value: '2',
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
        ])
    )
```

<a name="nullable"></a>
### Nullable

As with all fields, if you need to store NULL, you need to add the `nullable()` method.

```php
nullable(Closure|bool|null $condition = null)
```

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->nullable()
```
tab: Blade
```blade
<x-moonshine::form.select
    :nullable="true"
/>
```
~~~

![select nullable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_nullable.png#light)
![select nullable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_nullable_dark.png#dark)

<a name="placeholder"></a>
### Placeholder

The `placeholder()` method allows you to set the *placeholder* attribute for the field.

```php
placeholder(string $value)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country')
    ->nullable()
    ->placeholder('Country')
```

<a name="groups"></a>
## Groups

You can group values together.

~~~tabs
tab: array
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('City', 'city_id')
    ->options([
        'Italy' => [
            1 => 'Rome',
            2 => 'Milan',
        ],
        'France' => [
            3 => 'Paris',
            4 => 'Marseille',
        ]
    ])
```
tab: OptionGroup
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('City')
    ->options(
        new Options([
            new OptionGroup('Italy', new Options([
                new Option('Rome', '1'),
                new Option('Milan', '2'),
            ])),
            new OptionGroup('France', new Options([
                new Option('Paris', '3'),
                new Option('Marseille', '4'),
            ])),
        ])
    )
```
~~~

![select group](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_group.png#light)
![select group](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_group_dark.png#dark)

<a name="multiple"></a>
## Multiple values selection

To enable multiple values selection, use the `multiple()` method.

```php
multiple(Closure|bool|null $condition = null)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->multiple()
}
```

@include('_includes/note-about-multiple-cast')

![select multiple](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_multiple.png#light)
![select multiple](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_multiple_dark.png#dark)

<a name="search"></a>
## Search

If you need to add search functionality among values, then you need to add the `searchable()` method.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->searchable()
```
tab: Blade
```blade
<x-moonshine::form.select
    :searchable="true"
/>
```
~~~

![searchable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_searchable.png#light)
![searchable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_searchable_dark.png#dark)

<a name="async"></a>
## Asynchronous search

The `Select` field can also be set up for asynchronous searching.
To do this, you need to pass a *url* to the `async()` method, which will handle a request with the *query* parameter for the search.

```php
async(
    Closure|string|null $url = null,
    string|array|null $events = null,
    ?AsyncCallback $callback = null,
)
```

- `$url` - url or function to handle the asynchronous request,
- `$events` - list of events after the request has been executed (need a link to the events section),
- `$callback` - Callback after the request has been executed.

> [!NOTE]
> The parameters `$events` and `$callback` are not mandatory.

The response returned with the search results must be in *json* format.

```json
[
    {
        "value": 1,
        "label": "Option 1"
    },
    {
        "value": 2,
        "label": "Option 2"
    }
]
```

You can also use the `Options` object.

```php
public function selectOptions(): JsonResponse
{
    $options = new Options([
        new Option(
            label: 'Option 1',
            value: '1',
            selected: true,
            properties: new OptionProperty('https://cutcode.dev/images/platforms/youtube.png'),
        ),
        new Option(
            label: 'Option 2',
            value: '2',
            properties: new OptionProperty('https://cutcode.dev/images/platforms/youtube.png'),
        ),
    ]);

    return JsonResponse::make(data: $options->toArray());
}
```

The response will be:

```json
[{
    "value": "1",
    "label": "Option 1",
    "selected": true,
    "properties": {
        "image": "https:\/\/cutcode.dev\/images\/platforms\/youtube.png"
    }
}, {
    "value": "2",
    "label": "Option 2",
    "selected": false,
    "properties": {
        "image": "https:\/\/cutcode.dev\/images\/platforms\/youtube.png"
    }
}]
```

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->async('/search')
```
tab: Blade
```blade
<x-moonshine::form.select asyncRoute='/search' />
```
~~~

If you need to send the request for values immediately after the page is displayed, then you need to add the `asyncOnInit(whenOpen: false)` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->async('/search')
    ->asyncOnInit(whenOpen: false)
```

If `asyncOnInit()` or `asyncOnInit(whenOpen: true)` is empty, the request will be sent after clicking on `Select`.
And if it is necessary for the "Loader" to be shown before opening `Select`, then you can add `asyncOnInit(withLoading: true)`.

> [!NOTE]
> Don't forget to handle the `query` when using `async`, otherwise, the search will always return the same values.

<a name="n-change-event"></a>
## Change events

When the `Select` value changes, you can trigger events using the `onChangeEvent()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->onChangeEvent(
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects')
    ),
```

If the `Select` is in a form, then by default, all form data will be sent with the event when triggered.
If the form is large, you may need to exclude a set of fields.
Exclusions can be made through the `exclude` parameter.

```php
->onChangeEvent(
    AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects'),
    exclude: ['text', 'description']
)
```

You can also completely exclude sending data through the `withoutPayload` parameter.

```php
->onChangeEvent(
    AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects'),
    withoutPayload: true
)
```

<a name="update-on-preview"></a>
## Editing in preview mode

The `updateOnPreview()` method allows you to edit the `Select` field in "preview" mode.

```php
updateOnPreview(
    ?Closure $url = null,
    ?ResourceContract $resource = null,
    mixed $condition = null,
    array $events = [],
)
```

- `$url` - url for handling asynchronous request,
- `$resource` - `ModelResource` that the relationship points to,
- `$condition` - condition for executing the method,
- `$events` - list of events _when executed?_ (need a link to the events section).

> [!NOTE]
> Parameters are not mandatory and should be passed if the field operates outside of a resource.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country')
    ->updateOnPreview()
```

<a name="with-image"></a>
## Values with images

The `optionProperties()` method allows you to add an image to the value.

```php
optionProperties(Closure|array $data)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        1 => 'Andorra',
        2 => 'United Arab Emirates',
    ])
    ->optionProperties(fn() => [
        1 => ['image' => 'https://moonshine-laravel.com/images/ad.png'],
        2 => ['image' => 'https://moonshine-laravel.com/images/ae.png'],
    ])
```

Or via the `Options` object:

```php
Select::make('Select')
    ->options(
        new Options([
            new Option(
                label: 'Option 1',
                value: '1',
                selected: true,
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
            new Option(
                label: 'Option 2',
                value: '2',
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
        ])
    )
```

![belongs to image](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image.png#light)
![belongs to image](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image_dark.png#dark)

To customize images, provide an `OptionImage` object to `OptionProperty` rather than a string.

```php
new OptionProperty(
    new OptionImage(
        src: 'https://cutcode.dev/images/platforms/youtube.png',
        height: 6,
        width: 6,
        objectFit: ObjectFit::CONTAIN
    )
),
```

- `$src` - The URL of the image,
- `$height` - The height of the image (used to apply the `h-{x}` class, where `x` ranges from 1 to 10),
- `$width` - The width of the image (used to apply the `w-{x}` class, where `x` ranges from 1 to 10),
- `$objectFit` - One of the values from the `ObjectFit` enumeration (see [`object-fit`](https://developer.mozilla.org/en-US/docs/Web/CSS/object-fit) to learn more).

<a name="options"></a>
## Options

All *Tom Select* options are available for modification through *data attributes*.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        1 => 'Andorra',
        2 => 'United Arab Emirates',
    ])
    ->customAttributes([
        'data-remove-item-button' => true,
    ])

```

> [!TIP]
> For more detailed information refer to the [Tom Select documentation](https://tom-select.js.org/docs/).

<a name="option-attributes"></a>
## Option attributes

When using the `Option` object, you can set additional HTML attributes for each option.

### Creating via static method

The `Option` and `OptionGroup` objects support the static `make()` method for convenient creation.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Support\DTOs\Select\Option;
use MoonShine\Support\DTOs\Select\OptionGroup;
use MoonShine\Support\DTOs\Select\Options;

Option::make('Label', 'value')

OptionGroup::make('Group', new Options([
    Option::make('Option 1', '1'),
    Option::make('Option 2', '2'),
]))
```

### Disabling an option

The `disabled()` method allows you to disable a specific option.

```php
disabled(Closure|bool|null $condition = null)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\DTOs\Select\Option;
use MoonShine\Support\DTOs\Select\Options;

Select::make('Country')
    ->options(
        new Options([
            Option::make('Active', 'active'),
            Option::make('Disabled', 'disabled')->disabled(),
            Option::make('Conditional', 'conditional')->disabled(fn() => true),
        ])
    )
```

### Custom attributes

The `customAttributes()` method allows you to add arbitrary HTML attributes to an option.

```php
customAttributes(array $attributes)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\DTOs\Select\Option;
use MoonShine\Support\DTOs\Select\Options;

Select::make('Country')
    ->options(
        new Options([
            Option::make('Option 1', '1')->customAttributes(['data-info' => 'value']),
            Option::make('Option 2', '2')->customAttributes(['class' => 'custom-class']),
        ])
    )
```

The `customAttributes()` method is also available for `OptionGroup`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Support\DTOs\Select\Option;
use MoonShine\Support\DTOs\Select\OptionGroup;
use MoonShine\Support\DTOs\Select\Options;

Select::make('City')
    ->options(
        new Options([
            OptionGroup::make('Italy', new Options([
                Option::make('Rome', '1'),
                Option::make('Milan', '2'),
            ]))->customAttributes(['data-country' => 'it']),
        ])
    )
```

<a name="native"></a>
## Native display mode

The `native()` method disables the *Tom Select* library and outputs the `Select` in native mode.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->native()
```

<a name="plugins"></a>
## Plugins

The `addPlugin(array|string $plugin, array $pluginOptions = [])` method adds a plugin to `Select`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->addPlugin(['plugin_1', 'plugin_2'])

Select::make('Type')
    ->addPlugin('plugin_1', [
        'foo' => 'bar',
        ...
    ])
    ->addPlugin('plugin_2', [
        'foo' => 'bar',
        ...
    ])
```

> [!TIP]
> All official [plugins](https://tom-select.js.org/plugins/).

You can also create your own plugins very easily.

```js
document.addEventListener('moonshine:select_init', function({ detail: { createPlugin } }) {
    createPlugin('myPlugin', function(pluginOptions) {
        console.log(pluginOptions, this.getValue())

        this.on('change', value => {
            // ...
        })
    })
})
```

Next, connect the plugin as shown above.

> [!TIP]
> Complete documentation on [creating plugins](https://tom-select.js.org/docs/plugins/).

<a name="settings"></a>
## Custom settings

The `settings()` method allows all custom **Tom Select** settings to be used.

```php
settings(array|Settings $settings)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Select;
use MoonShine\Support\DTOs\Select\Settings;

Select::make('Type')
    ->settings(
        Settings::make()
            ->maxOptions(10)
            ->highlight(false)
    );
```

> [!TIP]
> All available [settings](https://tom-select.js.org/docs/#general-configuration).

<a name="fields-names"></a>
### Name settings

For all name settings, there is a very convenient `fieldsNames()` method.

```php
fieldsNames(FieldsNames $names)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Select;
use MoonShine\Support\DTOs\Select\FieldsNames;

Select::make('Type')
    ->fieldsNames(
        FieldsNames::make()
            ->value('id')
            ->label('name')
            ->children('children')
    );
```

<a name="async-settings"></a>
### Add. async settings

To further configure asynchrony, you can use the `asyncSettings()` method.

```php
asyncSettings(array|AsyncSettings $settings)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\DTOs\Select\AsyncSettings;
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->asyncSettings(
        AsyncSettings::make()
            // You can change the name of the search field
            ->queryKey('q')

            // You can send the current active values, just specify the name
            ->selectedValuesKey('name')

            // If the result is wrapped, for example, in data, then we indicate this key
            ->resultKey('data')

            // If you want all the fields of the current form to go along with the request
            ->withAllFields()
    );
```

You can also enable `withAllFields()` directly using the `asyncWithFields()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->asyncWithFields();
```

<a name="select-creatable"></a>
### Create new options

To switch to the "create new options" mode, you can use the `selectCreatable()` method.

```php
selectCreatable(
    ?string $filterRegex = null,
    bool $persist = true,
    bool $createOnBlur = false,
    bool $duplicates = false,
    bool $addPrecedence = false,
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->selectCreatable(
        /^\d+$/
    );
```

> [!TIP]
> Described in more detail [here](https://tom-select.js.org/examples/create-filter/).

<a name="select-max-items"></a>
### Maximum choice of options

If you need to limit the maximum selection of an option, you can use the `selectMaxItems()` method.

```php
selectMaxItems(
    ?int $limit = null,
    ?string $text = null
)
```

- `$limit` - max. quantity,
- `$text` - message if the limit is exceeded.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->selectMaxItems(5);
```

> [!TIP]
> Also see recipes for using [Select](/docs/{{version}}/recipes/select).
