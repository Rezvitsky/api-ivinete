<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'auth'], function () use ($router) {
	$router->post('login', 'AuthController@login');
    $router->post('signup', 'AuthController@signup');
    $router->post('logout', 'AuthController@logout');
});

$router->group(['prefix' => 'users', 'middleware' => 'auth'], function () use ($router) {
    $router->get('get', 'UsersController@get');
});

$router->group(['prefix' => 'pages', 'middleware' => 'auth'], function () use ($router) {
    $router->get('get-by-id', 'PagesController@getById');
    $router->post('create', 'PagesController@create');
});

$router->group(['prefix' => 'messages', 'middleware' => 'auth'], function () use ($router) {
    $router->get('get-conversations', 'MessagesController@getConversations');
});

$router->group(['prefix' => 'audio', 'middleware' => 'auth'], function () use ($router) {
	$router->get('/', 'AudioController@index');
    $router->get('get', 'AudioController@get');
    $router->post('save', 'AudioController@save');
});

$router->group(['prefix' => 'photos', 'middleware' => 'auth'], function () use ($router) {
    $router->get('get', 'PhotosController@get');
});

$router->group(['prefix' => 'wall', 'middleware' => 'auth'], function () use ($router) {
    $router->get('get', 'WallController@get');
    $router->post('post', 'WallController@post');
});

$router->group(['prefix' => 'friends', 'middleware' => 'auth'], function () use ($router) {
    $router->get('get', 'FriendsController@get');
});
