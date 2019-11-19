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

//ROTAS PARA GEST
Route::get('/', function () {
    return view('Gest.welcome');
});

Route::get('/about', function () {
    return view('Gest.about');
});

Route::get('/help', function () {
    return view('Gest.help');
});

Route::get('/contact', function () {
    return view('Gest.contact');
});

//ROTAS PARA AUTHENTICAÇÂO
Auth::routes();


Route::get('/query', 'SelectController@index');

//ROTAS PARA CLIENTE
Route::get('/client', 'ClientController@index');

Route::get('/client/profile','ClientController@profile');

//ROTAS PARA FUNCIONARIO

Route::get('/employee', 'EmployeeController@index');
