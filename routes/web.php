<?php

use App\Http\Controllers\SucursalController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Custom\HardCodeMenu;
use App\Http\Controllers\CategoriaTablaController;
use App\Models\CategoriaTabla;

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
    
    return Inertia::render('Home',["menus" =>HardCodeMenu::get_menu()]);
});

Route::resource('sucursal', SucursalController::class);
Route::resource('categoria', CategoriaController::class);
Route::get('/categoria/edit_tabla/{id}',function($id){
    $categoria = new CategoriaController();
    return $categoria->edit_tabla($id);
});
Route::resource('categoriatabla',CategoriaTablaController::class);

/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');














