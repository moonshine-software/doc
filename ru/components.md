
~~~tabs
tab: Class
```php
Component::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.component>components</x-moonshine.layout.component>
```
~~~

# Layouts
### Assets

```php
Assets::make()
```

```blade
<x-moonshine::layout.assets />
```

### Block

```php
Block::make(components: [])
```

```blade
<x-moonshine::layout.block>components</x-moonshine::layout.block>
```

### Body

```php
Body::make(components: [])
```

```blade
<x-moonshine::layout.body>components</x-moonshine::layout.body>
```

### Box

```php
Box::make('Label', components: [])->dark()
```

```blade
<x-moonshine::layout.box title="Label" :dark="true">components</x-moonshine::layout.box>
```


### Column

```php
Column::make(components: [])->columnSpan(6, 6)
```

```blade
<x-moonshine::layout.column colSpan="6" adaptiveColSpan="6">components[]</x-moonshine::layout.column>
```

~~~tabs

tab: Class
```php
Column::make(components: [])->columnSpan(6, 6)
```

tab: Blade
```blade
<x-moonshine::layout.column colSpan="6" adaptiveColSpan="6">components[]</x-moonshine::layout.column>
```
~~~

### Content

~~~tabs
tab: Class
```php
Content::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.content>components[]</x-moonshine.layout.content>
```
~~~
### Div

~~~tabs
tab: Class
```php
Div::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.div>components[]</x-moonshine.layout.div>
```
~~~
### Divider

~~~tabs
tab: Class
```php
Divider::make('Title')->centered()
```
tab: Blade
```blade
<x-moonshine::layout.divider label="Title" :is-centered="true" />
```
~~~
### Favicon

~~~tabs
tab: Class
```php
Favicon::make()
	// optional
	->assets(['test.js'])
	->bodyColor('#fff')
```
tab: Blade
```blade
<x-moonshine::layout.favicon :custom-assets="['test.js']" body-color="#fff" />
```
~~~
### Flash

~~~tabs
tab: Class
```php
Flash::make(key: 'flash', type: 'info', withToast: false, removable: false)
```
tab: Blade
```blade
<x-moonshine::layout.flash key="flash" type="info" :with-toast="false" :removable="false" />
```
~~~
### Flex

~~~tabs
tab: Class
```php
Flex::make([])  
    ->columnSpan(6, 6)  
    ->withoutSpace()  
    ->itemsAlign('center')  
    ->justifyAlign('start'),
```
tab: Blade
```blade
<x-moonshine::layout.flex col-span="6" adaptive-col-span="6" :without-space="true" items-align="center" justify-align="center">components</x-moonshine::layout.flex>
```
~~~
### Footer

~~~tabs
tab: Class
```php
Footer::make(components: [])->menu(['/' => '#'])->copyright('2020')
```
tab: Blade
```blade
<x-moonshine::layout.footer :menu="['/' => '#']" copyright="2020">components[]</x-moonshine::layout.footer>
```
~~~

### Grid

~~~tabs
tab: Class
```php
Grid::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.grid>components[]</x-moonshine::layout.grid>
```
~~~

### Head

~~~tabs
tab: Class
```php
Head::make(components: [])->title('Title')->bodyColor('#fff'),
```
tab: Blade
```blade
<x-moonshine::layout.head title="Title" body-color="#fff">components[]</x-moonshine::layout.head>
```
~~~
### Header

~~~tabs
tab: Class
```php
Header::make(components: []),
```
tab: Blade
```blade
<x-moonshine::layout.header>components[]</x-moonshine::layout.header>
```
~~~

### Html

~~~tabs
tab: Class
```php
Html::make(components: [])->withThemes()->withAlpineJs(),
```
tab: Blade
```blade
<x-moonshine::layout.html :with-themes="true" :with-alpine-js="true">components[]</x-moonshine::layout.html>
```
~~~
### Layout

~~~tabs
tab: Class
```php
Layout::make(components: [])->bodyColor('#fff'),
```
tab: Blade
```blade
<x-moonshine::layout bodyColor="#fff">components[]</x-moonshine::layout>
```
~~~

### LineBreak

~~~tabs
tab: Class
```php
LineBreak::make(),
```
tab: Blade
```blade
<x-moonshine::layout.line-break />
```
~~~

### Logo

~~~tabs
tab: Class
```php
Logo::make(href: '/', logo: 'logo.png', logoSmall: 'logo-small.png', title: 'Title')->minimized(),
```
tab: Blade
```blade
<x-moonshine::layout.logo href="/" logo="logo.png" logo-small="logo-small.png" title="Title" />
```
~~~

### Menu

~~~tabs
tab: Class
```php
Menu::make($menuManager)->top()->scrollTo(),
```
tab: Blade
```blade
<x-moonshine::layout.menu :menu-manager="$menuManager" :top="true" :scroll-to="true" />
```
~~~

### Meta

~~~tabs
tab: Class
```php
Meta::make()->customAttributes([  
    'name' => 'csrf-token',  
    'content' => 'token',  
])
```
tab: Blade
```blade
<x-moonshine::layout.meta name="csrf-token" content="token" />
```
~~~

### MobileBar

~~~tabs
tab: Class
```php
MobileBar::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.mobile-bar>components[]</x-moonshine::layout.mobile-bar>
```
~~~

### Sidebar

~~~tabs
tab: Class
```php
Sidebar::make(components: [])->collapsed()
```
tab: Blade
```blade
<x-moonshine::layout.sidebar :collapsed="true">components[]</x-moonshine::layout.sidebar>
```
~~~

### ThemeSwitcher

~~~tabs
tab: Class
```php
ThemeSwitcher::make()->top(),
```
tab: Blade
```blade
<x-moonshine::layout.theme-switcher :top="true" />
```
~~~

### TopBar

~~~tabs
tab: Class
```php
TopBar::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.top-bar>components[]</x-moonshine::layout.top-bar>
```
~~~

### Wrapper

~~~tabs
tab: Class
```php
Wrapper::make(components: [])
```
tab: Blade
```blade
<x-moonshine::layout.wrapper>components[]</x-moonshine::layout.wrapper>
```
~~~

# Metrics
### LineChart

~~~tabs
tab: Class
```php
LineChartMetric::make('Title')->line(['Line 1' => [1,2]], 'red')->withoutSortKeys(),
```
tab: Blade
```blade
<x-moonshine::metrics.line title="Title" :lines="" :colors="" :labels="" />
```
~~~

### Value

~~~tabs
tab: Class
```php
ValueMetric::make('Title')->value(90)->progress(100)->valueFormat('')->icon(''),
```
tab: Blade
```blade
<x-moonshine::metrics.value title="Title" :value="90" :progress="100" :icon="" :simple-value="" />
```
~~~
### DonutChart

~~~tabs
tab: Class
```php
DonutChartMetric::make('Title')->values(['CutCode' => 10000, 'Apple' => 9999])->colors(['#ffcc00', '#00bb00'])->decimals(0),
```
tab: Blade
```blade
<x-moonshine::metrics.donut title="Title" :values="[]" :labels="[]" :colors="[]" :decimals="0" />
```
~~~

# Basic

### ActionGroup

~~~tabs
tab: Class
```php
ActionGroup::make(actions: []),
```
tab: Blade
```blade
<x-moonshine::action-group :actions="[]">or here actions[]</x-moonshine::action-group>
```
~~~

### Alert

~~~tabs
tab: Class
```php
Alert::make(icon: 'users', type: 'info', removable: true)->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert icon="users" type="info" :removable="true">Text</x-moonshine::alert>
```
~~~
### Badge

~~~tabs
tab: Class
```php
Badge::make('Badge', color: 'red'),
```
tab: Blade
```blade
<x-moonshine::badge color="red">Badge</x-moonshine::badge>
```
~~~

### Boolean

~~~tabs
tab: Class
```php
Boolean::make(value: true),
```
tab: Blade
```blade
<x-moonshine::boolean :value="true" />
```
~~~
### Card

~~~tabs
tab: Class
```php
Card::make(title: 'Title')  
    ->url('/')  
    ->thumbnail('image.png')  
    ->subtitle('Subtitle')  
    ->values(['Key' => 'Value'])  
    ->header('Header')
    ->actions('Actions')
    ->overlay(),
```
tab: Blade
```blade
<x-moonshine::card title="Title" subtitle="Subtitle" thumbnail="image.png" url="/" :values="['Key' => 'Value']">
<x-slot:header>
Header
</x-slot:header>
<x-slot:actions>
Actions
</x-slot:actions>
</x-moonshine::card>
```
~~~
### Carousel

~~~tabs
tab: Class
```php
Carousel::make(['image1.png', 'image2.png'], portrait: true, alt: 'Alt'),
```
tab: Blade
```blade
<x-moonshine::carousel :items="['image1.png', 'image2.png']" :portrait="true" alt="Alt" />
```
~~~
### Color

~~~tabs
tab: Class
```php
Color::make('red'),
```
tab: Blade
```blade
<x-moonshine::color color="red" />
```
~~~

### Components

~~~tabs
tab: Class
```php
Components::make(components: []),
```
tab: Blade
```blade
<x-moonshine::components :components="[]">or components[]</x-moonshine::components>
```
~~~

### FieldsGroup

~~~tabs
tab: Class
```php
FieldsGroup::make(components: [])->previewMode()->fill([], [])->withoutWrappers(),
```
tab: Blade
```blade
<x-moonshine::fields-group :components="[]">or components[]</x-moonshine::fields-group>
```
~~~

### Dropdown

~~~tabs
tab: Class
```php
Dropdown::make('Title')  
    ->items(['Content 1', 'Content 2'])  
    ->searchable()  
    ->toggler('Open')  
    ->content('Slot')  
    ->searchPlaceholder('Placeholder')  
    ->footer('Footer')  
    ->placement('bottom-start'),
```
tab: Blade
```blade
<x-moonshine::dropdown 
	title="Title" 
	:items="['Content 1', 'Content 2']"
	:searchable="true"
	:searchPlaceholder="Placeholder"
	:placement="bottom-start"

<x-slot:toggler>
Open
</x-slot:toggler>
<x-slot:footer>
Footer
</x-slot:footer>
Slot
</x-moonshine::dropdown>
```
~~~

### Files

~~~tabs
tab: Class
```php
Files::make(['file.pdf', 'file2.pdf'], download: true),
```
tab: Blade
```blade
<x-moonshine::files :files="['file.pdf', 'file2.pdf']" :download="true"/>
```
~~~
### FlexibleRender

~~~tabs
tab: Class
```php
FlexibleRender::make('Content'),
```
tab: Blade
```blade
<x-moonshine::flexible-render content="Content" />
```
~~~

### Heading

~~~tabs
tab: Class
```php
Heading::make('Title')->h2(2, asClass: false),
```
tab: Blade
```blade
<x-moonshine::heading title="Title" h="2" :as-class="false" />
```
~~~

### Color

~~~tabs
tab: Class
```php
Icon::make(icon: 'users', size: 5, color: 'red', path: 'moonshine::icons')->custom(),
```
tab: Blade
```blade
<x-moonshine::icon icon="users" size="5" color="red" />
```
~~~

### Link

~~~tabs
tab: Class
```php
Link::make(href: '/', label: 'Label')->class('test'),
```
tab: Blade
```blade
<x-moonshine::link-native href="/" class="test">Label</x-moonshine::link-native>
```
~~~

### Modal (difficult)

~~~tabs
tab: Class
```php
Modal::make('Title', 'Content'),
```
tab: Blade
```blade
<x-moonshine::modal title="Title">Content</x-moonshine::modal>
```
~~~

### OffCanvas (difficult)

~~~tabs
tab: Class
```php
OffCanvas::make('Title', 'Content'),
```
tab: Blade
```blade
<x-moonshine::off-canvas title="Title">Content</x-moonshine::off-canvas>
```
~~~

### Popover

~~~tabs
tab: Class
```php
Popover::make('Title', trigger: 'Trigger', placement: 'right'),
```
tab: Blade
```blade
<x-moonshine::popover title="Title" trigger="Trigger" />
```
~~~

### ProgressBar

~~~tabs
tab: Class
```php
ProgressBar::make(80, 'sm', 'red')->radial()
```
tab: Blade
```blade
<x-moonshine::progress-bar value="80" size="sm" color="red" :radial="true" />
```
~~~

### Rating

~~~tabs
tab: Class
```php
Rating::make(3, min: 5, max: 1),
```
tab: Blade
```blade
<x-moonshine::rating value="3" min="5" max="1" />
```
~~~

### Tabs

~~~tabs
tab: Class
```php
Tabs::make([  
    Tab::make('Tab 1', [  
        FlexibleRender::make('Content 1')  
    ])  
]),
```
tab: Blade
```blade
<x-moonshine::tabs :items="['Tab 1' => 'Content 1']" />
```
~~~

### Thumbnails

~~~tabs
tab: Class
```php
Thumbnails::make(['image1.png', 'image2.png']),
```
tab: Blade
```blade
<x-moonshine::thumbnails :items="['image1.png', 'image2.png']" />
```
~~~

### Title

~~~tabs
tab: Class
```php
Title::make('Title', h: 2),
```
tab: Blade
```blade
<x-moonshine::title h="2">Title</x-moonshine::title>
```
~~~

### Url

~~~tabs
tab: Class
```php
Url::make('/', 'Link', icon: 'users', blank: true)->withoutIcon(),
```
tab: Blade
```blade
<x-moonshine::url href="/" value="Link" icon="users" :blank="true" :without-icon="true" />
```
~~~

### When

~~~tabs
tab: Class
```php
When::make(fn() => true, fn() => []),
```
~~~

# Form

### Main

~~~tabs
tab: Class
See FormBuilder
tab: Blade
```blade
<x-moonshine::form></x-moonshine::form>
```
~~~

### Input


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.input />
```
~~~

### Button


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.button />
```
~~~

### File


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.file />
```
~~~

### FileItem


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.file-item file="image.jpg" />
```
~~~

### Hint


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.hint>Hint</x-moonshine.form.hint>
```
~~~

### InputError


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.input-error>Error</x-moonshine.form.input-error>
```
~~~

### InputWrapper


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.input-wrapper>Content</x-moonshine.form.input-wrapper>
```
~~~

### Label


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.label>Content</x-moonshine.form.label>
```
~~~

### Select


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.select :values="[]" />
```
~~~

### SlideRange


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.slide-range fromName="from" toName="to" fromValue="0" toValue="100" />
```
~~~

### Switcher


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.switcher />
```
~~~

### Textarea


~~~tabs
tab: Class
See Fields

tab: Blade
```blade
<x-moonshine::form.textarea />
```
~~~

# Table (Difficult)
### Main

~~~tabs
tab: Class
See TableBuilder
tab: Blade
```blade
<x-moonshine::table>
<x-slot:tbody>
<tr><td>Cell</td></tr>
</x-slot:tbody>
</x-moonshine::table>
```
~~~
