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

Route::get('/help', 'FaqController@index');

Route::get('/contact', function () {
    return view('Gest.contact');
});

//ROTAS PARA AUTHENTICAÇÂO
Auth::routes();

Route::get('/query', 'SelectController@index');

//ROTAS PARA CLIENTE
Route::get('/client', 'ClientController@index');

Route::get('/client/profile','ClientController@profile');

Route::get('/client/appointment','AppointmentController@client');

Route::get('/client/analysis','ClientController@analysis');

Route::get('/client/support','EmployeeController@support');


//ROTAS PARA FUNCIONARIO

Route::get('/employee', 'EmployeeController@index');

Route::get('/employee/client','ClientController@getAllClients');

Route::get('/employee/appointment','AppointmentController@employee');

Route::get('/employee/medic','MedicController@getAllMedic');

Route::get('/employee/schedule','MedicController@schedule');

//ROTAS PARA API

Route::get('/api/faq', 'ApiController@getAllFaq');

Route::get('/api/medic', 'ApiController@getAllMedic');

Route::get('/api/medic/{id}', 'ApiController@getMedicSingle');

Route::get('/api/medic/{id}/appointments', 'ApiController@getMedicAppoint');

Route::get('/api/client/{id}', 'ApiController@getClientSingle');

Route::get('/api/client/{id}/appointments', 'ApiController@getClientAppoint');

Route::get('/api/client/{id}/analysis', 'ApiController@getClientAnalysis');





