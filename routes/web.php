<?php

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

$router->get(
    '/',
    [
        'uses' => 'MainController@home', // nomdDuController@@NomDeLaMethode
        'as'   => 'main-home' // nom de la route
    ]
);

//CATEGORIES
//all categories
$router->get(
    '/categories',
    [
        'uses' => 'CategoryController@list', // nomdDuController@@NomDeLaMethode
        'as'   => 'category-list' // nom de la route
    ]
);

//get one category
$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item', // nomdDuController@@NomDeLaMethode
        'as'   => 'category-item' // nom de la route
    ]
);

//TASKS
//get all tasks
$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list', // nomdDuController@@NomDeLaMethode
        'as'   => 'task-list' // nom de la route
    ]
);

//get one task
$router->get(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@item', // nomdDuController@@NomDeLaMethode
        'as'   => 'task-item' // nom de la route
    ]
);

//post one task
$router->post(
    '/tasks',
    [
        'uses' => 'TaskController@add', // nomdDuController@@NomDeLaMethode
        'as'   => 'task-add' // nom de la route
    ]
);

//update one task
$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update', // nomdDuController@@NomDeLaMethode
        'as'   => 'task-update' // nom de la route
    ]
);

//patch one task
$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update', // nomdDuController@@NomDeLaMethode
        'as'   => 'task-patch' // nom de la route
    ]
);
