<?php

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
Route::group(['prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware'=>['auth', 'Role:10']], function () {
    Route::get('/', 'DashboardController@index')->name('dash');
    Route::resource('users', 'UserController');
    Route::resource('news', 'NewsController');
    Route::resource('sections', 'SectionController');
    Route::resource('homesetting', 'HomesettingController');

//    Ajax route
    Route::post('/setscreen','HomeController@setScreen')->name('setscreen');
    Route::delete('/deleteItem/{id}','SectionController@destroy');
    Route::get('/getItem/{id}/edit','SectionController@edit');
    Route::post('/updateSec/{id}','SectionController@update');
    Route::post('/addItem','SectionController@store');
});

Route::get('/', 'HomeController@index');
