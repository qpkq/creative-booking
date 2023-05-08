# Creative Booking

API - Блог.

## Порты

Созданы следующие компоненты с подробным описанием открытых портов:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`
- **redis** - `:6379`
- **mailpit** - `:8025`

## Документация API

https://documenter.getpostman.com/view/25804337/2s93Y5PKTu

## Запуск

Запускаем докер-контейнеры из корневой папки проекта:

- `docker-compose up -d --build app`
- `docker-compose run --rm composer update`

Теперь в папке src:

- `cp .env.example .env`
- `php artisan key:generate`
- `docker-compose run --rm artisan migrate`