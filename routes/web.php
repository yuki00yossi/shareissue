<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
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

Route::get('/dashboard', [IssueController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/departments', [DepartmentController::class, 'index'])->middleware('auth')->name('departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->middleware('auth')->name('departments.create');
Route::post('/departments', [DepartmentController::class, 'store'])->middleware('auth')->name('departments.store');
Route::get('/departments/{department}', [DepartmentController::class, 'show'])->middleware('auth')->name('departments.show');
Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->middleware('auth')->name('departments.edit');
Route::put('/departments/{department}', [DepartmentController::class, 'update'])->middleware('auth')->name('departments.update');
// Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->middleware('auth')->name('departments.destroy');
Route::get('/departments/{department}/member/add', [DepartmentController::class, 'addMember'])->middleware('auth')->name('departments.addMember');
Route::post('/departments/{department}/member/add', [DepartmentController::class, 'storeMember'])->middleware('auth')->name('departments.storeMember');

Route::get('/projects', [ProjectController::class, 'index'])->middleware('auth')->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->middleware('auth')->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->middleware('auth')->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->middleware('auth')->name('projects.show');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->middleware('auth')->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->middleware('auth')->name('projects.update');
Route::get('/projects/{project}/member/add', [ProjectController::class, 'addMember'])->middleware('auth')->name('projects.addMember');
Route::post('/projects/{project}/member/add', [ProjectController::class, 'storeMember'])->middleware('auth')->name('projects.storeMember');

Route::get('/issues/create', [IssueController::class, 'create'])->middleware('auth')->name('issues.create');
Route::post('/issues', [IssueController::class, 'store'])->middleware('auth')->name('issues.store');
Route::get('/issues/{issue}', [IssueController::class, 'show'])->middleware('auth')->name('issues.show');

require __DIR__.'/auth.php';
