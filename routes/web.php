<?php
Route::get('','HomeController@index');
Route::get('/ajax/checkngay','AjaxController@checkngay');
Route::get('/ajax/checkngaykk','AjaxController@checkngaykk');
Route::get('/ajax/checkusername','AjaxController@checkusername');
Route::get('/ajax/checkmaqhns','AjaxController@checkmaqhns');
Route::get('/ajax/checkmasothue','AjaxController@checkmasothue');
Route::get('/ajax/registerthongtin','AjaxController@registerthongtin');
Route::get('/ajax/getTown','AjaxController@getTown');


// <editor-fold defaultstate="collapsed" desc="--Setting--">
Route::resource('general','GeneralConfigsController');
Route::get('setting','GeneralConfigsController@setting');
Route::post('setting','GeneralConfigsController@updatesetting');

Route::resource('district','DistrictController');
Route::resource('town','TownController');
Route::resource('company','CompanyController');

Route::resource('xetduyet_thaydoi_ttdoanhnghiep','XdTdTtDnController');
Route::post('xetduyet_thaydoi_ttdoanhnghiep/tralai','XdTdTtDnController@tralai');
Route::get('xetduyet_thaydoi_ttdoanhnghiep/{id}/duyet','XdTdTtDnController@duyet');

Route::resource('diabanhoatdong','DiaBanHdController');

//Users
Route::get('login','UsersController@login');
Route::post('signin','UsersController@signin');
Route::get('/change-password','UsersController@cp');
Route::post('/change-password','UsersController@cpw');
Route::get('/user_setting','UsersController@settinguser');
Route::post('/user_setting','UsersController@settinguserw');
Route::get('/checkpass','UsersController@checkpass');
Route::get('/checkuser','UsersController@checkuser');
Route::get('/checkmasothue','UsersController@checkmasothue');
Route::get('logout','UsersController@logout');
Route::get('users','UsersController@index');
Route::get('users/{id}/edit','UsersController@edit');
Route::patch('users/{id}','UsersController@update');
Route::get('users/{id}/phan-quyen','UsersController@permission');
Route::post('users/phan-quyen','UsersController@uppermission');
Route::post('users/delete','UsersController@destroy');
Route::get('users/lock/{id}/{pl}','UsersController@lockuser');
Route::get('users/unlock/{id}/{pl}','UsersController@unlockuser');
Route::get('users/create','UsersController@create');
Route::post('users','UsersController@store');

//EndUsers
// </editor-fold>//End Setting




