# Тестовое задание для WebSecret

## Установка

Установите docker и docker-compose.

Скопируйте .env

```shell
cp .env.example .env
```

Ставим зависимости
```shell
docker-compose run --rm back composer install
```

Запускаем
```shell
docker-compose up
```

Создаем базу данных
```shell
docker-compose exec db psql -U postgres -c "create database backend;"
```

Наполнение базы данных тестовыми сущностями
```shell
docker-compose exec back php artisan migrate:fresh --seed
```

В браузере открываем http://localhost

Запуск команд artisan
```shell
docker-compose exec back ash # Внутри контейнера выполняем как обычно php artisan foo:bar
# или
docker-compose exec back php artisan foo:bar
# например накатить миграции
docker-compose exec back php artisan migrate
```

## Что сделано

* Реализовано 5 методов для каждой сущности:
  - index (список сущностей)
  - store (создание)
  - show (выдача по id)
  - update (редактирование)
  - destroy (удаление)
    
* Валидация входных данных и вывод ошибок валидации
* Пагинация при выдаче списка сотрудников
* Запрет на удаление отдела с сотрудниками
* Ошибки возвращаются в формате JSON
* Составлена документация и отдается по route "/api"
* Минимизировано количество запросов к БД
* Наполнение базы тестовыми данными

## Что не сделано, но хотелось бы

* Добавить метод поиска по имени для всех сущностей (упрощает нахождение и использование необходимых данных)
* Добавить метод массового редактирования (при удалении большого отдела ускоряет процесс)
* Unit-тесты (помогают при ловле багов после расширения функционала)

## Затраченное время
10 часов
