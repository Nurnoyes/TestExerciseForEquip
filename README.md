# TestExerciseForEquip

Работу я делал на докере. Для запуска переходим в папку docker_s и выполяем команды:
            docker-compose build
            docker-compose up -d
Для запуска докера.
После этого, нужно будет засидить database:
            docker-compose exec php-fpm bash
            php artisan db:seed 
После чего импортируется БД




******************************************************************************************************************************************



для запросов были реализованы роуты:
Route::get('/groups', [App\Http\Controllers\Api\ShopController::class, 'index']);
Route::get('/groups/group_id/{id}', [App\Http\Controllers\Api\ShopController::class, 'show']);
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/products/parent_id/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
Route::get('/products/parent_id/{id}/sortBy={sorting}/orderBy={ordering}', [App\Http\Controllers\Api\ProductController::class, 'sorting']);
Route::get('/product_id/{id}', [App\Http\Controllers\Api\SingleProductController::class, 'show']);
К сожалению, я успел сделать только Бэк, но не полностью
    /api/groups показывает список всех групп товаров, в принципе не нужная функция но на всякий случай я ее релаизовал
    /api/groups/group_id/{id} показывает потомков папки. Нужен для реализации функционала сайта    
    /api/products - показывет список всех продуктов
    /api/products/parent_id/{id} - показывает список продуктов которые принадлежат конкретной директории
    /api/products/parent_id/{id}/sortBy={sorting}/orderBy={ordering} - список продуктов с сортировкой(sortBy=name|price, а orderBy=ASC|DESC)
    /api/product_id/{id} - карточка товара
Бэк был реализован почти полностью, хоть в моменте я и осознал свои ошибки, и не успел доделать до приемлемого вида. Результаты своей попытки создать основную функцию для работы внутри группм можете наблюдать в файле Models/Groups
Хлебные крошки также можно было бы реализовать, если бы я смог создать адекватную функцию для поиска потомков у родительских папок.
MySQL не работал, поэтому пришлось работать с Postrges, благо нашел хорошее решение для быстрого перевода скрипта с MySQL на Postrges
