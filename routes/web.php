<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

//Docs

Route::get('/docs/mydocs', 'Docs@index');

Route::get('/mylist', 'Docs@getMyDocs');

Route::get('/docs/list', 'Docs@getDocs');

Route::get('/docs/create', 'Docs@createFile');

Route::post('/docs/store', 'Docs@storeFile');

Route::get('/docs/show/{id}', 'Docs@showFile');

Route::get('/docs/download/{id}', 'Docs@downloadFile');

Route::post('/docs/delete', 'Docs@deleteFile');

Route::get('/docs/edit/{id}', 'Docs@editFile');

Route::post('/docs/update/{id}', 'Docs@updateFile');

Route::get('/docs/search', 'Docs@searchFiles');

//Users

Route::get('/user/profile', 'Users@profile');

Route::get('/user/edit', 'Users@edit');

Route::get('/user/delete', 'Users@deleteUser');

Route::post('/user/update', 'Users@update');

//Perms

Route::get('/perms/show/{id}', 'Perms@showPerms');

Route::post('/perms/delete', 'Perms@deletePerms');

Route::post('/perms/new', 'Perms@newPerms');

Route::get('/perms/show/list/{id}', 'Perms@getUsers');

Route::post('/perms/filename', 'Perms@getFilename');

//Idioma Datatables

Route::get('/datatablesEs', 'DTable@datatablesEs');

//Help

Route::get('/help', 'DTable@showHelp');
