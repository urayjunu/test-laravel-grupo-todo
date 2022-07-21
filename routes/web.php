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

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;


Route::get('/', 'ProductoController@listado');

Route::group(['prefix' => 'front'], function () {

    //front producto
    Route::get('productos', 'ProductoController@listado');
    Route::get('productos/{id}', 'ProductoController@list');
    Route::get('producto/{id}', 'ProductoController@detalle');


    //front categoria
    Route::get('categorias', 'CategoriaController@listado');
    Route::get('categoria/{id}', 'CategoriaController@detalle');

});

Auth::routes();

//Route::group(['prefix' => 'admin'], function () {
Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
    // admin Producto
    Route::get('producto/{id}', 'ProductoController@show');
    Route::get('productos', 'ProductoController@index');
    Route::post('agregarProducto', 'ProductoController@store');
    Route::post('actualizarProducto', 'ProductoController@update');
    Route::delete('eliminarProducto/{id}', 'ProductoController@destroy');
    Route::get('productoPorId/{id}', 'ProductoController@productoPorId');

    //  admin Categoria
    Route::get('categoria/{id}', 'CategoriaController@show');
    Route::get('categorias', 'CategoriaController@index');
    Route::post('agregarCategoria', 'CategoriaController@store');
    Route::post('actualizarCategoria', 'CategoriaController@update');
    Route::delete('eliminarCategoria/{id}', 'CategoriaController@destroy');
    Route::get('buscarCategoria/{nombre}', 'CategoriaController@search');
    Route::get('categoriaPorId/{id}', 'CategoriaController@categoriaPorId');

});
Route::get('/home', 'HomeController@index')->name('home');
