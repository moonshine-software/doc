https://moonshine-laravel.com/docs/resource/advanced/advanced-commands?change-moonshine-locale=en

------

# Commands

- [Install](#install)
- [Apply](#apply)
- [Component](#component)
- [Controller](#controller)
- [Field](#field)
- [Handler](#handler)
- [Page](#page)
- [Policy](#policy)
- [Resource](#resource)
- [Type cast](#type_cast)
- [User](#user)
- [Publish](#publish)

>[!WARNING]
>To select the appropriate item, you must use the `space` key.

<a name="install"></a>
# Install

Command to install the **MoonShine** package in your *Laravel* project:

```php
php artisan moonshine:install
```

Available options:

- `-u`, `--without-user` - without creating a super user;
- `-m`, `--without-migrations` - without performing migrations.

>[!NOTE]
>For more detailed information, please refer to the section [Installation](https://moonshine-laravel.com/docs/resource/getting-started/installation).

<a name="apply"></a>
# Apply

The command to create the apply class is:

```php
php artisan moonshine:apply
```

After executing the command, a file will be created in the `app/MoonShine/Applies` directory. The created class must be registered with the service provider.

<a name="component"></a>
# Component

The command creates a custom component:

```php
php artisan moonshine:component
```

After executing the command, a class for the component will be created in the `app/MoonShine/Components` directory and *Blade* file in the `resources/views/admin/components` directory.

>[!NOTE]
>For more detailed information, please refer to the section [Components](https://moonshine-laravel.com/docs/resource/components/components-index).

<a name="controller"></a>
# Controller

Command to create a controller:

```php
php artisan moonshine:controller
```

After executing the command, a controller class will be created in the `app/MoonShine/Controllers` directory. Which can be used in admin panel routes.

>[!NOTE]
>For more detailed information, please refer to the section [Controllers](https://moonshine-laravel.com/docs/resource/advanced/advanced-controller).

<a name="field"></a>
# Field

The command allows you to create a custom field:

```php
php artisan moonshine:field
```

When executing the command, you can specify whether the field will extend the base class or another field.

After executing the command, a field class will be created in the `app/MoonShine/Fields` directory and *Blade* file in the directory `/resources/views/admin/fields`.

>[!NOTE]
>For more detailed information, please refer to the section [Field](https://moonshine-laravel.com/docs/resource/fields/fields-index).

<a name="handler"></a>
# Handler

The command creates a Handler class for its import and export implementations:

```php
php artisan moonshine:handler
```

After executing the command, the handler class will be created in the directory `app/MoonShine/Handlers`.

>[!NOTE]
>For more detailed information, please refer to the section [Import/Export](https://moonshine-laravel.com/docs/resource/models-resources/resources-import_export).

<a name="page"></a>
# Page

The command creates a page for the admin panel:

- `--crud` - creates a group of pages: index, detail and form page;
- `--dir=` - the directory in which the files will be located relative to `app/MoonShine`, default Page;
- `--extends=` - a class that the page will extend, for example IndexPage, FormPage or DetailPage.

After executing the command, a default page (or group of pages) will be created in the directory `app/MoonShine/Pages`.

>[!NOTE]
>For more detailed information, please refer to the section [Page](https://moonshine-laravel.com/docs/resource/page/page-class).

<a name="policy"></a>
# Policy

The command creates a *Policy* bound to the admin panel user:

```php
php artisan moonshine:policy
```

After executing the command, a class will be created in the `app/Policies` directory.

>[!NOTE]
>For more detailed information, please refer to the section [Authorization](https://moonshine-laravel.com/docs/resource/advanced/advanced-authorization).

<a name="resource"></a>
# Resource

Command to create resources:

```php
php artisan moonshine:resource
```

Available options:

- `--m|model=` - Eloquent model for model resource;
- `--t|title=` - section title;
- `--test` or `--pest` - additionally generate a test class.

There are several options available when creating a *Resource*:

- **[Default model resource](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#default)** - model resource with common fields;
- **[Separate model resource](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#separate)** - model resource with field separation;
- **[Model resource with pages](https://moonshine-laravel.com/docs/resource/models-resources/resources-pages)** - model resource with pages;
-**Empty resource** - empty resource.

After executing the command, a resource file will be created in the `app/MoonShine/Resources/` directory.
If a model resource with pages is created, additional pages will be created in the directory `app/MoonShine/Pages`.

>[!NOTE]
>For more detailed information, please refer to the section [Models Resorces](https://moonshine-laravel.com/docs/resource/models-resources/resources-index).

<a name="type_cast"></a>
# Type Cast

The command creates a TypeCast class for working with data:

```php
php artisan moonshine:type-cast
```

After executing the command, a file will be created in the `app/MoonShine/TypeCasts` directory.

>[!NOTE]
>For more detailed information, please refer to the section [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts).

<a name="user"></a>
# User

The command that allows you to create a super user:

```php
php artisan moonshine:user
```

Available options:

- `--u|username=` - user login/email;
- `--N|name=` - user name;
- `--p|password=` - password.

<a name="publish"></a>
# Publish

Command for publish:

```php
php artisan moonshine:publish
```
There are several options available for publishing:

- **Assets** - **MoonShine** admin panel assets;
- **[Assets template](https://moonshine-laravel.com/docs/resource/appearance/appearance-assets#vite)** - creates a template for adding your own styles to the **MoonShine** admin panel;
- **[Layout](https://moonshine-laravel.com/docs/resource/appearance/appearance-layout_builder)** - MoonShineLayout class, responsible for the general appearance of the admin panel;
- **[Favicons](https://moonshine-laravel.com/docs/resource/appearance/appearance-index#favicons)** - overrides the template for changing favicons;
- **System Resources** - system MoonShineUserResource, MoonShineUserRoleResource, which you can change.

#### You can immediately specify the publication type in the command.

```php
php artisan moonshine:publish assets
```

Available types:
- assets
- assets-template
- layout
- favicons
- resources
