<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('welcome');
});

Route::get('/getDashboard', [UserController::class, 'getDashboard']);

Route::get('/getUsers', [UserController::class, 'getUsers']);
Route::post('/addUser', [UserController::class, 'addUser']);
Route::post('/editUser', [UserController::class, 'editUser']);
Route::post('/deleteUser', [UserController::class, 'deleteUser']);

Route::get('/getRoles', [UserController::class, 'getRoles']);
Route::post('/addRole', [UserController::class, 'addRole']);
Route::post('/editRole', [UserController::class, 'editRole']);
Route::post('/deleteRole', [UserController::class, 'deleteRole']);

Route::get('/getExpenses', [UserController::class, 'getExpenses']);
Route::post('/addExpense', [UserController::class, 'addExpense']);
Route::post('/editExpense', [UserController::class, 'editExpense']);
Route::post('/deleteExpense', [UserController::class, 'deleteExpense']);

Route::get('/getCategories', [UserController::class, 'getCategories']);
Route::post('/addCategory', [UserController::class, 'addCategory']);
Route::post('/editCategory', [UserController::class, 'editCategory']);
Route::post('/deleteCategory', [UserController::class, 'deleteCategory']);
