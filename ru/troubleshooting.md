# Поиск и устранение неисправностей

  - [Изображения не отображаются](#images-are-not-displayed)
  - [Язык по умолчанию](#default-language)
  - [Проблемы с https](#problems-with-https)
  - [Ошибка "Страница не найдена"](#error-page-not-found)

---

<a name="images-are-not-displayed"></a>
## Изображения не отображаются
- Убедитесь, что вы выполнили команду `php artisan storage:link`
- Убедитесь, что выбран диск по умолчанию `public`, а не `local`
- Проверьте, что `APP_URL` в файле `.env` указан правильно

```php
APP_URL=http://moonshine.test:8080
```

<a name="default-language"></a>
## Язык по умолчанию
Если вы оставили только один язык в конфигурации MoonShine, но в панели используется другой язык.

- Убедитесь, что в конфигурации Laravel `config/app.php` указан тот же язык, что и в MoonShine

<a name="problems-with-https"></a>
## Проблемы с https
Если у вас есть формы, использующие URL с http, но ожидающие https:

- Убедитесь, что у вас качественный SSL-сертификат
- В middleware `TrustProxies` установите `protected $proxies = ['*']`

<a name="error-page-not-found"></a>
## Ошибка "Страница не найдена"
- Проверьте наличие MoonShineServiceProvider в `config/app.php`
Например, пакет Apiato изменяет свою структуру, и MoonShine не может быть добавлен провайдером автоматически. Добавьте его самостоятельно
- Убедитесь, что ресурс или страница объявлены в `MoonShineServiceProvider`
- Очистите кэш

