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
/* Admin */
Route::get('/', function () {
    return redirect('login');
});


Route::get('/categories', 'HomeController@getCategories');
Route::get('/videos/{categoryId}', 'HomeController@getVideosByCategory');
Route::get('/audios', 'HomeController@getAllAudios');



//Login Controller's
Route::get('/login', function () {
  return view('login');
});
Route::get('/redirect', 'HomeController@redirectURL')->name('redirect');
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@authenticate']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);

//Admin Controller's
Route::group(['prefix'=>'admin','middleware'=>['auth','AccessAdmin']],function(){

  Route::get('/', 'AdminController@homeAdmin');
  Route::post('/category', 'AdminController@saveCategory');
  Route::post('/video', 'AdminController@saveVideo');
  Route::get('/edit/{id}', 'AdminController@editCategory');
  Route::post('/edit/{id}', 'AdminController@updateCategory');
  Route::get('/edit-video/{id}', 'AdminController@editVideo');
  Route::post('/edit-video/{id}', 'AdminController@updateVideo');
  Route::post('/audio', 'AdminController@saveAudio');


});
