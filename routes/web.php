<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Empresas;

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

Route::get('/', [Empresas::class, 'index']);
Route::get('get_by_id', [Empresas::class, 'get_by_id']);
Route::post('agregar', [Empresas::class, 'agregar']);
Route::post('editar', [Empresas::class, 'editar']);
Route::post('eliminar', [Empresas::class, 'eliminar']);