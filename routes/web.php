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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
 * APi Routes
 * Namespaces indicate folder structure
 * throttle设置接口每分钟请求频率   每分钟20 次
 */
Route::group(['namespace' => 'Admin', 'as' => 'admin.','prefix' => 'admin'], function () {

    includeRouteFiles(__DIR__.'/Admin/');
});