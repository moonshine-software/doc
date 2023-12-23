<x-page title="Testing">
<x-sub-title>Создание ресурса с тестовым файл</x-sub-title>

Добавив флаг --test к команде <code>moonshine:resource</code>,
вы можете сгенерировать тестовый файл вместе с базовым набором тестов:

<x-code language="shell">
php artisan moonshine:resource PostResource --test
</x-code>

Помимо создания ресурса, приведенная выше команда сгенерирует следующий тестовый файл
<code>tests/Feature/PostResourceTest.php</code>

Если вы используете Pest, то можете указать опцию --pest

<x-code language="shell">
    php artisan moonshine:resource PostResource --pest
</x-code>

Пример теста успешного ответа главной страницы ресурса

<x-code>
public function test_index_page_successful(): void
{
    $response = $this->get(
        $this->getResource()->indexPageUrl()
    )->assertSuccessful();
}
</x-code>

<x-sub-title>Установка аутентифицированного пользователя</x-sub-title>

Хотя тестирование MoonShine ресурсов ничем не отличается от стандартных тестов вашего приложения и
установка аутентифицированного пользователя для запроса не должна вызывать сложность,
мы все равно приведем пример:

<x-code>
protected function setUp(): void
{
    parent::setUp();

    $user = MoonshineUser::factory()->create();

    $this->be($user, 'moonshine');
}
</x-code>
</x-page>
