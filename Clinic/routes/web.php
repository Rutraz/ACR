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
//ROTAS PARA ADMIN

Route::get("/admin", 'AdminController@index' );// VIEW PRINCIPAL
//--------CLientes
Route::get('/admin/clients','AdminController@getAllClients');
Route::post("/admin/client/{id}",'AdminController@EraseClient');

//--------Medicos
Route::get("/admin/medics","AdminController@getAllMedics");
Route::post("/admin/medics/edit","AdminController@modifyMedic");
Route::post("/admin/medics/{id}","AdminController@EraseMedic");


//--------Funcionarios
Route::get("/admin/employees","AdminController@getAllEmployees");
Route::post("/admin/employee/edit", "AdminController@modifyEmployees");
Route::post("/admin/employee/{id}", "AdminController@EraseEmployee");



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

Route::get('/client/news','AppointmentController@CheckAppointClient');

//--------PROFILE
Route::get('/client/profile','ClientController@profile'); // ENVIA A INFORMAÇÃO DO CLIENTE COM CONSULTAS E ANALISES

Route::get('/client/profile/edit','ClientController@editProfile'); // ENVIA A INFORMAÇÃO DO CLIENTE 

Route::post('/client/profile/edit','ClientController@submitEditProfile'); // MODIFICA A INFORMAÇÃO DO CLIENTE 

Route::post('/client/profile/edit/email','ClientController@submitEditEmail'); // MODIFICA A INFORMAÇÃO DO CLIENTE

Route::post('/client/profile/edit/password','ClientController@submitEditPassword'); // MODIFICA A INFORMAÇÃO DO CLIENTE

Route::post('/client/profile/erase','ClientController@eraseProfile'); // ELIMINA O PERFIL

//--------CONSULTAS
Route::get('/client/appointment','AppointmentController@client');

Route::get('/client/appointment/medic/{id}','MedicController@clientMedic');

Route::post('/client/appointment/medic/{id}','AppointmentController@createAppoint');

Route::post('/client/appointment/comment','AppointmentController@modifyComment');

Route::post('/client/appointment/cancel','AppointmentController@clientChangeStatus');

Route::post('/client/appointment/rate','AppointmentController@modifyRating');

Route::get('/client/appointment/medic/{id}/calendar','MedicController@clientMedicCalendar');


//--------ANALISES
Route::get('/client/analysis','AnalysisController@clientAnalysis'); // ENVIA AS ANÁLISES MARCADAS

Route::post('/client/analysis/cancel','AnalysisController@clientChangeStatus');

Route::post('/client/analysis/create','AnalysisController@createAnalysis');

//--------SUPORTE
Route::get('/client/support','EmployeeController@support'); // ENVIA A INFORMAÇÃO DOS FUNCIONARIOS

//----------------------------------------------
//ROTAS PARA FUNCIONARIO
Route::get('/employee', 'EmployeeController@index'); // ENVIA A INFORMAÇÃO DO FUNCIONARIO

//--------CLIENTES
Route::get('/employee/client','ClientController@getAllClients'); 
Route::get('/api/employee/client','ClientController@getAllCliApi'); // ENVIA A INFORMAÇÃO DE TODOS OS CLIENTE

//--------CONSULTAS
Route::get('/employee/appointment','AppointmentController@employee');
Route::post('/employee/appointment/change','AppointmentController@employeeChangeStatus');
Route::get('/employee/appointment/{id}','AppointmentController@singleAppointment');
Route::get('/employee/appointment/medic/{id}','MedicController@EmployeeMedicAppoint');
Route::post('/employee/appointment/medic/{id}','AppointmentController@createAppointEmployee');


//--------ANALISES
Route::get('/employee/analysis','AnalysisController@employeeAnalysis'); // ENVIA A INFORMAÇÃO DE TODAS AS ANÁLISES
Route::post('/employee/analysis/change','AnalysisController@employeeChangeStatus');
Route::post('/employee/analysis/create','AnalysisController@createEmployeeAnalysis');

//--------MEDICOS
Route::get('/employee/medic','MedicController@getAllMedic'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS
Route::get('/employee/medic/{id}','MedicController@EmployeeMedic');
Route::post('/employee/medic/comment','AppointmentController@EraseComment');


Route::get('/medic/search','MedicController@medicSearch');
Route::get('/client/search','ClientController@clientSearch');

//----------------------------------------------
//ROTAS PARA API -> IR AO VerifyCsrfToken para retirar a token 

Route::get('/api/faq', 'FaqController@getAllFaq'); // ENVIA A INFORMAÇÃO DAS FAQ

Route::post('/api/faq', 'FaqController@insertFaq'); // CRIA UMA FAQ

Route::post('/api/faq/erase/{id}', 'FaqController@eraseFaq'); // CRIA UMA FAQ

Route::get('/api/medic/orderer', 'ApiController@getAllMedicOrdered'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

Route::get('/api/medic/esp', 'ApiController@getAllMedicBySpec'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

Route::get('/api/medic', 'ApiController@getAllMedic'); // ENVIA A INFORMAÇÃO DE TODOS OS MEDICOS

Route::post('/api/medic', 'ApiController@createMedic'); // CRIAR UM MEDICO

Route::get('/api/medic/{id}', 'ApiController@getMedicSingle'); // ENVIA A INFORMAÇÃO DO MEDICO ID=X

Route::get('/api/medic/{id}/appointments', 'ApiController@getMedicAppoint'); // ENVIA A INFORMAÇÃO DAS CONSULTAS DO MEDICO ID=X

Route::post('/api/client', 'ApiController@createClient'); // CRIAR UM CLIENTE

Route::post('/api/employee/create', 'ApiController@createEmployee'); // CRIAR UM FUNCIONARIO

Route::get('/api/client/{id}', 'ApiController@getClientSingle'); // ENVIA A INFORMAÇÃO DO CLIENTE ID=X

Route::get('/api/client/{id}/appointments', 'ApiController@getClientAppoint'); // ENVIA A INFORMAÇÃO DAS CONSULTAS DO CLIENTE ID=X

Route::get('/api/client/{id}/analysis', 'ApiController@getClientAnalysis'); //ENVIA A INFORMAÇÃO DAS ANALISES DO CLIENTE X


Route::get('/api/client/user/{id}', 'ApiController@getClientSingleUser'); // ENVIA A INFORMAÇÃO DO CLIENTE ID=X


Route::get('/api/analysis','AnalysisController@returnAnalysis');

Route::get('/api/appointment/medic/{id}/calendar','MedicController@MedicCalendar');