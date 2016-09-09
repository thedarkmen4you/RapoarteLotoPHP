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

Route::auth();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

/*
 * Bilete
 */
Route::resource('bilete', 'BileteController');

/*
 * Setari
 */
Route::resource('setari', 'SetariController');

/*
 * Contoare electronice
 */
Route::resource('contoare_electronice', 'ContoareElectroniceController');

/*
 * Contoare mecanice
 */
Route::resource('contoare_mecanice', 'ContoareMecaniceController');