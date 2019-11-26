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
    return view('Gest.welcome'); // VIEW PRINCIPAL
});

Route::get('/about', function () {
    return view('Gest.about'); // VIEW SOBRE NOS
});

Route::get('/help', 'FaqController@index'); // ENVIA INFORMAÇÃO DAS PERGUNTAS E RESPOSTAS DAS FAQ

Route::get('/contact', function () {
    return view('Gest.contact'); // VIEW CONTACTOS
});

//----------------------------------------------
//ROTAS PARA AUTHENTICAÇÂO
Auth::routes();

Route::get('/query', 'SelectController@index'); // VERIFICA SE É CLIENTE OU FUNCIONARIO

//----------------------------------------------
//ROTAS PARA CLIENTE
Route::get('/client', 'ClientController@index'); // ENVIA A INFORMAÇÃO DO CLIENTE

//--------PROFILE
Route::get('/client/profile','ClientController@profile'); // ENVIA A INFORMAÇÃO DO CLIENTE COM CONSULTAS E ANALISES

Route::get('/client/profile/edit','ClientController@editProfile'); // ENVIA A INFORMAÇÃO DO CLIENTE 

Route::post('/client/profile/edit','ClientController@submitEditProfile'); // MODIFICA A INFORMAÇÃO DO CLIENTE 

Route::post('/client/profile/edit/email','ClientController@submitEditEmail'); // MODIFICA A INFORMAÇÃO DO CLIENTE

Route::post('/client/profile/edit/password','ClientController@submitEditPassword'); // MODIFICA A INFORMAÇÃO DO CLIENTE

Route::post('/client/profile/erase','ClientController@eraseProfile'); // ELIMINA O PERFIL

//--------CONSULTAS
Route::get('/client/appointment','AppointmentController@client');

//--------ANALISES
Route::get('/client/analysis','AnalysisController@clientAnalysis'); // ENVIA AS ANÁLISES MARCADAS

//--------SUPORTE
Route::get('/client/support','EmployeeController@support'); // ENVIA A INFORMAÇÃO DOS FUNCIONARIOS

//----------------------------------------------
//ROTAS PARA FUNCIONARIO
Route::get('/employee', 'EmployeeController@index'); // ENVIA A INFORMAÇÃO DO FUNCIONARIO

//--------CLIENTES
Route::get('/employee/client','ClientController@getAllClients'); // ENVIA A INFORMAÇÃO DE TODOS OS CLIENTE

//--------CONSULTAS
Route::get('/employee/appointment','AppointmentController@employee');

//--------ANALISES
Route::get('/employee/analysis','AnalysisController@employeeAnalysis'); // ENVIA A INFORMAÇÃO DE TODAS AS ANÁLISES

//--------MEDICOS
Route::get('/employee/medic','MedicController@getAllMedic'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

//--------HORARIOS
Route::get('/employee/schedule','MedicController@schedule'); // ENVIA A HORARIOS DOS MEDICOS

//----------------------------------------------
//ROTAS PARA API -> IR AO VerifyCsrfToken para retirar a token 

Route::get('/api/faq', 'FaqController@getAllFaq'); // ENVIA A INFORMAÇÃO DAS FAQ

Route::post('/api/faq', 'FaqController@insertFaq'); // CRIA UMA FAQ

Route::get('/api/medic/orderer', 'ApiController@getAllMedicOrdered'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

Route::get('/api/medic/esp', 'ApiController@getAllMedicBySpec'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

Route::get('/api/medic', 'ApiController@getAllMedic'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

Route::post('/api/medic', 'ApiController@createMedic'); // CRIAR UM MEDICO

Route::get('/api/medic/{id}', 'ApiController@getMedicSingle'); // ENVIA A INFORMAÇÃO DO MEDICO ID=X

Route::get('/api/medic/{id}/appointments', 'ApiController@getMedicAppoint'); // ENVIA A INFORMAÇÃO DAS CONSULTAS DO MEDICO ID=X

Route::post('/api/client', 'ApiController@createClient'); // CRIAR UM CLIENTE

Route::get('/api/client/{id}', 'ApiController@getClientSingle'); // ENVIA A INFORMAÇÃO DO CLIENTE ID=X

Route::get('/api/client/{id}/appointments', 'ApiController@getClientAppoint'); // ENVIA A INFORMAÇÃO DAS CONSULTAS DO CLIENTE ID=X

Route::get('/api/client/{id}/analysis', 'ApiController@getClientAnalysis'); //ENVIA A INFORMAÇÃO DAS ANALISES DO CLIENTE X





