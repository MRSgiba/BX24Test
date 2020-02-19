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

Route::group(['prefix' => 'bx24', 'middleware' => 'bx24', 'as' => 'bx24.'], function () {

    Route::prefix('v1')->name('v1.')->group(function () {

        /**
         * any используется для того, что избежать проблем с добавлением приложения
         * в Маркетплейс. Фрейм приложения на портале отправляет post-запрос, однако
         * Маркет шлет get и не отправляет аутентификационные данные, поэтому middleware
         * стоит выбрасывать 200 статус на время добавления приложения в Маркете
         */
        Route::any('', 'Bx24\V1\AppController@index')->name('index')->middleware('bx24.installed');
        Route::any('install', 'Bx24\V1\AppController@install')->name('install');

    });

});

