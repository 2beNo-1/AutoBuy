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

Route::get('/home', function () {
    return view('backend.dashboard');
})->name('admin');

Route::group([
    '/admin',
    'namespace' => 'Backend',
    'middleware' => ['auth'],
], function () {

    // 产品路由
    Route::get('/product/index', 'ProductController@index')->name('admin.product.index');
    Route::get('/product/add', 'ProductController@create')->name('admin.product.add');
    Route::post('/product/add', 'ProductController@store');
    Route::get('/product/{id}/edit', 'ProductController@edit')->name('admin.product.edit');
    Route::post('/product/{id}/edit', 'ProductController@update');
    Route::get('/product/{id}/destroy', 'ProductController@destroy')->name('admin.product.destroy');

});