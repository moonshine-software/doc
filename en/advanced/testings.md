https://moonshine-laravel.com/docs/resource/advanced/advanced-testings?change-moonshine-locale=en

------

# Testing

## Creating a resource with a test file

By adding the --test flag to the `moonshine:resource` command, you can generate a test file along with a basic test suite:

```php
php artisan moonshine:resource PostResource --test
```

Apart from creating the resource, the above command will generate the following test file `tests/Feature/PostResourceTest.php`. If you are using Pest, you can specify the --pest option:

```php
php artisan moonshine:resource PostResource --pest
```

An example of a test for a successful response from the main resource page:

```php
public function test_index_page_successful(): void
{
    $response = $this->get(
        $this->getResource()->indexPageUrl()
    )->assertSuccessful();
}
```

## Setting up an authenticated user

Although testing MoonShine resources is no different from standard testing of your application and setting up an authenticated user for the request should not be difficult, we'll give an example anyway:

```php
protected function setUp(): void
{
    parent::setUp();

    $user = MoonshineUser::factory()->create();

    $this->be($user, 'moonshine');
}
```
