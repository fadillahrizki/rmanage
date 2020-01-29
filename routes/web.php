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

Route::prefix('/')->middleware('auth')->group(function(){

    Route::get('', 'HomeController@index')->name('home');
    Route::get('get', 'HomeController@get')->name('get');
    
    Route::prefix('menu')->group(function(){

        Route::get('{ID}/get','MenuController@get')->name('menu.get');
        Route::get('{ID}','MenuController@single')->name('menu.single');
        Route::delete('{ID}','MenuController@delete')->name('menu.delete');
        Route::put('{ID}','MenuController@update')->name('menu.update');
        Route::post('create','MenuController@create')->name('menu.create');

        Route::prefix('{menu_id}/menu_item')->group(function(){

            Route::post('create','MenuItemController@create')->name('menu.item.create');
            Route::put('{ID}','MenuItemController@update')->name('menu.item.update');
            Route::delete('{ID}','MenuItemController@delete')->name('menu.item.delete');

            Route::prefix('{menu_item_id}/item')->group(function(){

                Route::post('create','ItemController@create')->name('item.create');
                Route::put('{ID}','ItemController@update')->name('item.update');
                Route::delete('{ID}','ItemController@delete')->name('item.delete');
                
            });
        });
    });  

});

Auth::routes();
