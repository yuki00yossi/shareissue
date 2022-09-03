<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartmentController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::resource('departments', DepartmentController::class);

Route::get('/departments', [DepartmentController::class, 'index'])->middleware('auth')->name('departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->middleware('auth')->name('departments.create');
Route::post('/departments', [DepartmentController::class, 'store'])->middleware('auth')->name('departments.store');
Route::get('/departments/{department}', [DepartmentController::class, 'show'])->middleware('auth')->name('departments.show');
Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->middleware('auth')->name('departments.edit');
Route::put('/departments/{department}', [DepartmentController::class, 'update'])->middleware('auth')->name('departments.update');
// Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->middleware('auth')->name('departments.destroy');
Route::get('/departments/{department}/member/add', [DepartmentController::class, 'addMember'])->middleware('auth')->name('departments.addMember');
Route::post('/departments/{department}/member/add', [DepartmentController::class, 'storeMember'])->middleware('auth')->name('departments.storeMember');


require __DIR__.'/auth.php';
