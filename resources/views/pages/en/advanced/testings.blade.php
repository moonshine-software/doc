<x-page title="Testing">
<x-sub-title>Creating a resource with a test file</x-sub-title>

By adding the --test flag to the <code>moonshine:resource</code> command,
you can generate a test file along with a basic test suite:

<x-code language="shell">
php artisan moonshine:resource PostResource --test
</x-code>

Apart from creating the resource, the above command will generate the following test file
<code>tests/Feature/PostResourceTest.php</code>

If you are using Pest, you can specify the --pest option

<x-code language="shell">
php artisan moonshine:resource PostResource --pest
</x-code>

An example of a test for a successful response from the main resource page

<x-code>
public function test_index_page_successful(): void
{
    $response = $this->get(
        $this->getResource()->indexPageUrl()
    )->assertSuccessful();
}
</x-code>

<x-sub-title>Setting up an authenticated user</x-sub-title>

Although testing MoonShine resources is no different from standard testing of your application and
setting up an authenticated user for the request should not be difficult,
We'll give an example anyway:

<x-code>
protected function setUp(): void
{
    parent::setUp();

    $user = MoonshineUser::factory()->create();

    $this->be($user, 'moonshine');
}
</x-code>
</x-page>
