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

/////////////////////////////////////////////// WEB ////////////////////////////////////////////////
Route::get('/', 'WebController@index')->name('home');
Route::get('/implementers', 'WebController@implementers')->name('implementers');
Route::get('/implementers/{slug}', 'WebController@implementer')->name('implementer');

Route::group(['middleware' => ['auth', 'admin']], function () {
	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/profile', 'AdminController@profile')->name('profile');
	Route::get('/admin/profile/edit', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/profile/', 'AdminController@profileUpdate')->name('profile.update');

	// Administradores
	Route::get('/admin/administrators', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin/administrators/create', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin/administrators', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin/administrators/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin/administrators/{slug}/edit', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin/administrators/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::delete('/admin/administrators/{slug}', 'AdministratorController@destroy')->name('administradores.delete');
	Route::put('/admin/administrators/{slug}/activate', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin/administrators/{slug}/deactivate', 'AdministratorController@deactivate')->name('administradores.deactivate');

	// Implementadores
	Route::get('/admin/implementers', 'ImplementerController@index')->name('implementadores.index');
	Route::get('/admin/implementers/create', 'ImplementerController@create')->name('implementadores.create');
	Route::post('/admin/implementers', 'ImplementerController@store')->name('implementadores.store');
	Route::get('/admin/implementers/{slug}', 'ImplementerController@show')->name('implementadores.show');
	Route::get('/admin/implementers/{slug}/edit', 'ImplementerController@edit')->name('implementadores.edit');
	Route::put('/admin/implementers/{slug}', 'ImplementerController@update')->name('implementadores.update');
	Route::delete('/admin/implementers/{slug}', 'ImplementerController@destroy')->name('implementadores.delete');
	Route::put('/admin/implementers/{slug}/activate', 'ImplementerController@activate')->name('implementadores.activate');
	Route::put('/admin/implementers/{slug}/deactivate', 'ImplementerController@deactivate')->name('implementadores.deactivate');

	// Banners
	Route::get('/admin/banners', 'BannerController@index')->name('banners.index');
	Route::get('/admin/banners/create', 'BannerController@create')->name('banners.create');
	Route::post('/admin/banners', 'BannerController@store')->name('banners.store');
	Route::get('/admin/banners/{slug}', 'BannerController@show')->name('banners.show');
	Route::get('/admin/banners/{slug}/edit', 'BannerController@edit')->name('banners.edit');
	Route::put('/admin/banners/{slug}', 'BannerController@update')->name('banners.update');
	Route::delete('/admin/banners/{slug}', 'BannerController@destroy')->name('banners.delete');
	Route::put('/admin/banners/{slug}/activate', 'BannerController@activate')->name('banners.activate');
	Route::put('/admin/banners/{slug}/deactivate', 'BannerController@deactivate')->name('banners.deactivate');
});