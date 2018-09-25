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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@mostrarAViewHome');//tela home

Route::post('/api/abrirLink', 'LinksController@abrirLink');//retorna o link

Route::post('/api/ocultarLink', 'LinksController@ocultarLink');//retorna true

Route::post('/api/lerLinks','LinksController@lerOsLinksViaAjax');//retorna N links
