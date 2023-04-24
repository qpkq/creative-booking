# Creative Booking

API интернет-магазина.

Довольно упрощенный рабочий процесс Docker Compose, который настраивает сеть контейнеров для локальной разработки Laravel.

## Использование

Запуск контейнеров `docker-compose up -d --build app`.

**Примечание**: имя хоста вашей базы данных MySQL должно быть `mysql`, **не** `localhost`. Имя пользователя и база данных должны быть «homestead» с паролем «secret».

Созданы следующие компоненты с подробным описанием открытых портов:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`
- **redis** - `:6379`
- **mailpit** - `:8025`

Примеры команд:

- `docker-compose run --rm composer update`
- `docker-compose run --rm artisan migrate`