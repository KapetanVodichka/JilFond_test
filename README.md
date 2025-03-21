# JilFond_test

Это тестовый проект на Laravel. Проект включает функционал авторизации, корзины, оформления заказов и управления балансом пользователя.

## Основные возможности
- Регистрация и авторизация пользователей.
- Просмотр каталога товаров.
- Добавление товаров в корзину.
- Оформление заказов с списанием средств с баланса пользователя.
- Просмотр истории заказов.

## Установка и запуск

### 1. Клонирование репозитория
Склонируйте проект с GitHub:
```bash
git clone https://github.com/KapetanVodichka/JilFond_test.git
cd JilFond_test
```

### 2. Установка зависимостей
Установите PHP-зависимости через Composer:
```bash
composer install
```


### 3. Настройка окружения
Скопируйте файл .env.example в .env:
```bash
cp .env.example .env
```
Использовался sqlite так что ничего менять не нужно.
Сгенерируйте ключ приложения
```bash
php artisan key:generate
```

### 4. БД
```bash
php artisan migrate
php artisan db:seed
```

### 6. Запуск проекта
```bash
php artisan serve
```


