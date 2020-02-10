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
use App\Http\Controllers\CategriaController;


Route::get('/', 'ProductoController@index');


//Pizza
Route::get('producto/{id}', 'ProductoController@show');
Route::get('productos', 'ProductoController@index');
Route::post('agregarProducto', 'ProductoController@store');
Route::post('actualizarProducto', 'ProductoController@update');
Route::delete('eliminarProducto/{id}', 'ProductoController@destroy');
Route::get('productoPorId/{id}', 'ProductoController@productoPorId');



//Ingredient
Route::get('categoria/{id}', 'CategriaController@show');
Route::get('categorias', 'CategriaController@index');
Route::post('agregarCategoria', 'CategriaController@store');
Route::post('actualizarCategoria', 'CategriaController@update');
Route::delete('eliminarCategoria/{id}', 'CategriaController@destroy');
Route::get('buscarCategoria/{nombre}', 'CategriaController@search');
Route::get('categoriaPorId/{id}', 'CategriaController@categoriaPorId');
