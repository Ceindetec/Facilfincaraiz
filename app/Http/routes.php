<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('registro','Auth\AuthController@registroUser')->name('registroUser');
Route::get('contacto','mainController@contacto')->name('contacto');



Route::post('mail','MailController@enviar')->name('enviar');


Route::get('administrar', 'AdministradorController@adminBanner')->name('adminBanner');
Route::post('eliminaBanner', 'AdministradorController@deleteImgBanner')->name('deleteImgBanner');
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('getReset');
Route::post('password/reset/{token}', 'Auth\PasswordController@postReset')->name('postReset');


Route::get('/', function () {
    return view('welcome');
})->name('home');
