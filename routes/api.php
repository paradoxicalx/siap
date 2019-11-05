<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API User
|--------------------------------------------------------------------------
*/
use App\Http\Resources\User as UserResource;
use App\User;

Route::group(['middleware' => ['auth:api', 'authadmin', 'localization']], function () {
  /*
  | Insert user data
  */
  Route::post('/user/store', 'UserController@store');
  /*
  | View All user data
  */
  // Route::get('/users', function () {return UserResource::collection(User::all());});
  /*
  | View All user data with pagination
  */
  // Route::get('/users/{pag}', function ($pag=10) {return UserResource::collection(User::paginate($pag));});
  /*
  | View user for datatables
  */
  Route::get('/users/dt/{role}', 'UserController@usersDt');
  /*
  | View single user data
  */
  // Route::get('/user/show/{id}', function ($id) {return new UserResource(User::findOrFail($id));});
  /*
  | View latest user
  */
  // Route::get('/users/latest/{jml}', 'UserController@usersLatest');
  /*
  | Update user data
  */
  // Route::post('/user/update/{id}', 'UserController@update');
  /*
  | Delete user data
  */
  // Route::post('/user/destroy/{id}', 'UserController@destroy');


  /*
  | View product for datatables
  */
  Route::get('/products/dt/{catagory}', 'ProductController@productDt');
});
