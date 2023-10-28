<x-page title="Авторизация">

<x-p>
    Если необходимо добавить дополнительную логику авторизации в приложении или во внешнем пакете,
    то воспользуйтесь методом <code>defineAuthorization</code> в <code>AuthServiceProvider</code>
</x-p>

<x-code language="php">
public function boot(): void
{
    MoonShine::defineAuthorization(
        static function (ResourceContract $resource, Model $user, string $ability): bool {
            return true;
        }
    );
}
</x-code>

</x-page>
