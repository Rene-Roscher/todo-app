<?php

use App\Actions\Todo\AddTodoEntryAction;
use App\Actions\Todo\ShowTodoListAction;
use App\Actions\Todo\UpdateTodoEntryAction;
use App\Exceptions\ViewException;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//    $categories = user()->categories()->paginate(10);
//
//    return \App\Data\Collection\CategoryListData::collection($categories);
//
//    die('test');
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', ShowTodoListAction::class)->name('dashboard');
    Route::prefix('{category}')->name('category.')->group(function () {
        Route::post('create-todo', AddTodoEntryAction::class)->name('add-todo-entry');
    });
    Route::prefix('{todo}')->name('todo.')->group(function () {
        Route::post('update', UpdateTodoEntryAction::class)->name('update-todo-entry');
    });
});