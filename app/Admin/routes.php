<?php

//use App\Admin\Controllers\UserController; do not import this when import you will have error
//use App\Admin\Controllers\FoodsController;
//use App\Admin\Controllers\FoodTypeController;


use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UsersController::class);
    $router->resource('foods', FoodsController::class);
    $router->resource('food-types', FoodTypeController::class);


//    $router->resource('article-types', ArticleTypeController::class);

});
