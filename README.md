# :houses: Веб-приложение для аренды загородных домов

Проект был создан во время выполнения курсового проекта. Имеется разделение прав пользователя и администратора. Администратор может управлять всей информацией (CRUD). Все маршруты администратора защищены от пользователя с помощью middleware. Пользователь может бронировать дома. Забронировать можно только свободный дом.

Использованные технологии: **Laravel**

Все модули проекта распределены по своим директориям. Названия файлов отражают их суть. При наименовании чего-либо придерживался ресурсного стиля, принятого в Laravel.

База данных была создана с помощью миграций.

## :cinema: Демонстрация проекта:

Главная, регистрация, авторизация

![Demo](https://media.giphy.com/media/y5joRUGWEeZNgLC8vU/giphy.gif)

Панель администратора

![Demo](https://media.giphy.com/media/ukzkhAQpcy0msVu2jZ/giphy.gif)

Функционал пользователя

![Demo](https://media.giphy.com/media/YWHP4RDNRrictgwkyo/giphy.gif)

## :twisted_rightwards_arrows: Созданные маршруты

| № | Путь | Название | Http метод | Middleware | Контроллер, метод |
| --- | --- | --- | --- | --- | --- |
| 1 | / | index | GET | x | IndexController, index |
| 2 | /registration | registration | GET | x | RegisterController, index |
| 3 | /registration | registration | POST | x | RegisterController, save |
| 4 | /login | login | GET | x | LoginController, index |
| 5 | /login | login | POST | x | LoginController, store |
| 6 | /logout | logout | GET | x | LoginController, logout |
| 7 | /profile | profile | GET | auth | IndexController, profile |
| 8 | /rent/{id} | rent-house | GET | auth | RentController, index |
| 9 | /rent/{id} | rent-house | POST | auth | RentController, rentHouse |
| 10 | /admin | admin.index | GET | auth, admin | IndexController, admin |
| 11 | /admin/categories | admin.categories.categoires | GET | auth, admin | CategoryController, index |
| 12 | /admin/categories/create | admin.categories.create-category | GET | auth, admin | CategoryController, create |
| 13 | /admin/categories/create | admin.categories.create-category | POST | auth, admin | CategoryController, store |
| 14 | /admin/categories/{category}/edit | admin.categories.edit-category | GET | auth, admin | CategoryController, edit |
| 15 | /admin/categories/{category}/edit | admin.categories.edit-category | PUT | auth, admin | CategoryController, update |
| 16 | /admin/categories/{category} | admin.categories.delete-category | DELETE | auth, admin | CategoryController, destroy |
| Маршруты | для | домов | аналогичны | маршрутам | категорий |
| 17 | /admin/orders | admin.orders.orders | GET | auth, admin | OrderController, index |
| 18 | /admin/orders/{order}/change-status | admin.orders.change-status-order | GET | auth, admin | OrderController, editStatus |
| 19 | /admin/orders/{order}/change-status | admin.orders.change-status-order | POST | auth, admin | OrderController, updateStatus |

## :deciduous_tree: Файловая структура функциональной части проекта

Что создано мной. Как видите, всё распределено по своим разделам.
```
.
├── app
|   ├── Http
|   |   ├── Controllers
|   |   |   ├── CategoryController.php
|   |   |   ├── HouseController.php
|   |   |   ├── IndexController.php
|   |   |   ├── LoginController.php
|   |   |   ├── OrderController.php
|   |   |   ├── RegisterController.php
|   |   |   └── RentController.php
|   |   └── Middleware
|   |       └── IsAdmin.php
|   └── Models
|       ├── Category.php
|       ├── House.php
|       ├── Order.php
|       ├── Status.php
|       └── User.php
```
