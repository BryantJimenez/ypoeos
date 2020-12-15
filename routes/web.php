<?php

use Illuminate\Support\Facades\Route;

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

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes(['register' => false]);
Route::get('/administradores/email', 'AdminController@emailVerifyAdmin');
Route::get('/usuarios/email', 'AdminController@emailVerifyPeople');

Route::group(['middleware' => ['login']], function () {
	Route::get('/ingresar', 'AuthController@loginForm')->name('ingresar');
	Route::get('/registro', 'AuthController@registerForm')->name('registro');
	Route::get('/recuperar', 'AuthController@recoveryForm')->name('recuperar');
	Route::get('/restaurar/{slug}/{token}', 'AuthController@resetForm')->name('restaurar');
	Route::post('/ingresar', 'AuthController@login')->name('login.custom');
	Route::post('/registro', 'AuthController@register')->name('register.custom');
	Route::post('/recuperar', 'AuthController@recovery')->name('recovery.custom');
	Route::post('/restaurar/{slug}/{token}', 'AuthController@reset')->name('reset.custom');
});

Route::group(['middleware' => ['session_verify']], function () {
	Route::group(['middleware' => ['web.session']], function () {
		Route::post('/salir', 'AuthController@logout')->name('logout.custom');
	});
	
	/////////////////////////////////////////////// WEB ////////////////////////////////////////////////
	Route::get('/', 'WebController@index')->name('home');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/perfil', 'AdminController@profile')->name('profile');
	Route::get('/admin/perfil/editar', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/perfil/', 'AdminController@profileUpdate')->name('profile.update');

	// Administradores
	Route::get('/admin/administradores', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin/administradores/registrar', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin/administradores', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin/administradores/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin/administradores/{slug}/editar', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin/administradores/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::delete('/admin/administradores/{slug}', 'AdministratorController@destroy')->name('administradores.delete');
	Route::put('/admin/administradores/{slug}/activar', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin/administradores/{slug}/desactivar', 'AdministratorController@deactivate')->name('administradores.deactivate');
});