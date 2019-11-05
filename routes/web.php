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
Route::get('/', function () { return view('welcome'); });
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['authadmin']], function () {
  // Reset API api_token
  Route::get('/reset-api', 'ApiTokenController@update');

  //Dashboard
  Route::get('/dashboard', function () { return view('_admin.dashboard.index'); });

  // User
  Route::get('/users/list/{role}', 'UserController@index');
  Route::get('/user/create/{role}', 'UserController@create');

  // Product
  Route::get('/products', 'ProductController@index');

});
