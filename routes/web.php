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
/*
Route::get('/login', function () {
    return view('login');
});
*/





//Redirect Applications


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
  Route::get('/create-certificate', 'AdminController@certificate');
  Route::post('/create-certificate', 'AdminController@create_certificate');
  Route::get('/alerts', function () {return view('admin.alerts');});
  Route::get('/active-inactive', function () {return view('admin.active-inactive');});
  Route::get('/admin-settings', function () {return view('admin.admin-settings');});
  Route::get('/table', function () {return view('admin.table');});
  Route::get('/table/{id}', 'AdminController@loadResult');
  Route::get('/edit-certificate/{id}', 'AdminController@getcertificate');
  Route::post('/edit-certificate/{id}', 'AdminController@editcertificate');

});


Route::group(['prefix'=>'user','middleware'=>['auth','AccessUser']],function(){
  Route::get('/',function(){return view('user.send-via');});
  /* User */
  Route::get('/account',function(){return view('user.send_certificate');});
  Route::get('/client-list',function(){return view('user.client-list');});
  Route::get('/get-password',function(){return view('user.get-password');});
  Route::get('/history',function(){return view('user.history');});
  Route::get('/login',function(){return view('user.login');});
  Route::get('/reset-password',function(){return view('user.reset-password');});
  Route::get('/certificate',function(){return view('user.send_certificate');});
  Route::get('/send-via',function(){return view('user.send-via');});
  Route::get('/support',function(){return view('user.support');});


});
