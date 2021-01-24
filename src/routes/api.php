<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

  //  Route::apiResource('App\Http\Controllers\sneakers', 'SneakerController');
   // Route::post('sneakers/{sneaker}/ratings', 'RatingController@store');
 

Route::post('/v1/notes', 'NotesController@create');
Route::get('/v1/notes', 'NotesController@allNotes');
Route::get('/v1/notes/author/{authorId}', 'NotesController@notesByAuthor');
Route::delete('v1/notes/{id}', 'NotesController@permanentDelete'); //this on first permanent delete models
Route::delete('v2/notes/{id}', 'NotesController@softDelete');
Route::get('v2/notes/withsoftdelete','NotesController@notesWithSoftDelete');
Route::get('v2/notes/softdeleted','NotesController@softDeleted');
Route::patch('/v1/notes/{id}','NotesController@restore');
Route::delete('v3/notes/{id}','NotesController@permanentDeleteSoftDeleted');





$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers',
    'middleware' => [
    'api.throttle',
    ],
    'limit' => 20, 'expires' => 1,  // each route have a limit of 20 of 1 minutes
],
function ($api) {
  
    // Auth register
    $api->post('register', [
        'as' => 'auth.register',
        'uses' => 'PassportAuthController@register',
    ]);
    // Auth login
    $api->post('login', [
        'as' => 'auth.login',
        'uses' => 'PassportAuthController@login',
    ]);

    // Sneakers list
    $api->get('sneakers', [
        'as' => 'sneaker.index',
        'uses' => 'SneakerController@index',
    ]);
     // Sneakers show
    $api->get('sneakers/{id}', [
        'as' => 'sneaker.show',
        'uses' => 'SneakerController@show',
    ]);

    $api->get('search', [
        'as' => 'sneaker.search',
        'uses' => 'SneakerController@search',
    ]);



 // need authentication
 $api->group(['middleware' => 'auth:api'], function ($api) {

    // Sneaker create
    $api->post('sneakers', [
        'as' => 'sneaker.store',
        'uses' => 'SneakerController@store',
    ]);

        // Sneaker update
    $api->put('/sneakers/{id}', [
        'as' => 'sneaker.update.put',
        'uses' => 'SneakerController@update',
    ]);

    $api->patch('/sneakers/{id}', [
        'as' => 'sneaker.update.patch',
        'uses' => 'SneakerController@update',
    ]);

        // Sneaker delete
    $api->put('/sneakers/{id}', [
        'as' => 'sneaker.destroy',
        'uses' => 'SneakerController@destroy',
    ]);

          // Sneaker rating
    $api->post('/sneakers/{id}/rating', [
        'as' => 'sneaker.rating',
        'uses' => 'RatingController@store',
    ]);


 });




   
});


