<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Api\ContainersController;

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

Route::group(['middleware' => 'auth'], function () {

    //Images
    Route::resource('images', ImagesController::class);


    //Containers
    Route::post('containers-instace', [ImagesController::class, 'configureContainer'])->name('instance.configure');
    Route::get('containers-instace', [ContainersController::class, 'index'])->name('instance.index');
    Route::resource('containers', ContainersController::class);
    Route::get('terminal-tab/{docker_id}', [ContainersController::class, 'terminalNewTab'])->name('container.terminalTab');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
