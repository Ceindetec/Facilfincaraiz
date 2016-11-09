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

Route::get('registro','usuarioController@registroUser')->name('registroUser');
Route::post('registro','usuarioController@registroUserPost')->name('registroUserPost');
Route::get('contacto','mainController@contacto')->name('contacto');

Route::post('municipios','usuarioController@getMunicipios')->name('municipios');


Route::group(['middleware' => ['auth', 'superAdmin']], function () {

    Route::get('registroAdmins','AdministradorController@registroAdmins')->name('registroAdmins');
    Route::post('registroAdminsPost','AdministradorController@registroAdminsPost')->name('registroAdminsPost');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::post('eliminaBanner', 'AdministradorController@deleteImgBanner')->name('deleteImgBanner');
    Route::get('admin', function () {
        return 'Hello Admin o super ';
    });

    Route::get('administrar', 'AdministradorController@adminBanner')->name('adminBanner');
    Route::post('eliminaBanner', 'AdministradorController@deleteImgBanner')->name('deleteImgBanner');
    Route::post('administrador/subirimagen', 'AdministradorController@subirImagen')->name('subirImagen');

    Route::get('publicPendientes', 'AdministradorController@publicPendientes')->name('publicPendientes');
    Route::get('publicAprobadas', 'AdministradorController@publicAprobadas')->name('publicAprobadas');
    Route::get('publicInactivas', 'AdministradorController@publicInactivas')->name('publicInactivas');

    Route::post('pendientes', 'AdministradorController@pendientes')->name('pendientes');
    Route::post('aprobadas', 'AdministradorController@aprobadas')->name('aprobadas');
    Route::post('inactivas', 'AdministradorController@inactivas')->name('inactivas');

    Route::get('validarPublicVehiculo/{id}', 'AdministradorController@validarPublicVehiculo')->name('validarPublicVehiculo');
    Route::get('validarPublicInmueble/{id}', 'AdministradorController@validarPublicInmueble')->name('validarPublicInmueble');
    Route::get('validarPublicTerreno/{id}', 'AdministradorController@validarPublicTerreno')->name('validarPublicTerreno');

    Route::post('subirPublic', 'AdministradorController@subirPublic')->name('subirPublic');

    Route::post('deleteImgPublic', 'AdministradorController@deleteImgPublic')->name('deleteImgPublic');

    Route::get('marcaDeAgua', 'AdministradorController@marcaDeAgua')->name('marcaDeAgua');
    Route::post('autoCompleUsuarios','AdministradorController@autoCompleUsuarios')->name('autoCompleUsuarios');
    Route::post('infoUsuario','AdministradorController@infoUsuario')->name('infoUsuario');

});

Route::group(['middleware' => ['auth', 'usuario']], function () {

    Route::get('publicar','usuarioController@publicar')->name('publicar');
    Route::get('publicar/{categoria}','usuarioController@publicarXCategoria')->name('publicarXCategoria');
    Route::post('publicarInmueble','usuarioController@publicarInmueble')->name('publicarInmueble');
    Route::post('publicarVehiculo','usuarioController@publicarVehiculo')->name('publicarVehiculo');




});

Route::post('mail','MailController@enviar')->name('enviar');




Route::get("binmuebles","busquedasController@buscarinmuebles")->name("binmuebles");
Route::get("vehiculos","busquedasController@buscarVehiculos")->name("buscarVehiculos");
Route::post('marcas','usuarioController@getMarcas')->name('marcas');

Route::post('filtroVehiculos','busquedasController@getVehiculos')->name('getVehiculos');
Route::get("filtroVehiculos","busquedasController@buscarVehiculos")->name("buscarVehiculos");
Route::get("articulo/{id}", 'busquedasController@getArticulo')->name('getArticulo');

Route::get('password/email', 'Auth\PasswordController@getEmail')->name('getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('getReset');
Route::post('password/reset/{token}', 'Auth\PasswordController@postReset')->name('postReset');

Route::get('/', 'mainController@index', 'index')->name('home');



/*************************************************** PRUEBAAAAAAAAAAAAAAASSSSSS ****************************************************/

Route::get("imagencargaprueba","purebasController@imagencarga");
Route::post("postcargaimagen","purebasController@postcargaimagen")->name("postcargaimagen");
Route::get("vistadatatable","purebasController@vistadatatable");
Route::post("pruebadatatable","purebasController@getpruebadatatable")->name("pruebadatatable");