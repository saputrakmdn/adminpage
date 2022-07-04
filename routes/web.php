<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/siswa', [App\Http\Controllers\SiswaController::class, 'index'])->middleware('auth')->name('siswa.index');
Route::post('/siswa/store', [App\Http\Controllers\SiswaController::class, 'store'])->middleware('auth')->name('siswa.store');
Route::get('/siswa/edit/{id}', [App\Http\Controllers\SiswaController::class, 'edit'])->middleware('auth')->name('siswa.edit');
Route::post('/siswa/update/{id}', [App\Http\Controllers\SiswaController::class, 'update'])->middleware('auth')->name('siswa.update');
Route::post('/siswa/delete/{id}', [App\Http\Controllers\SiswaController::class, 'destroy'])->middleware('auth')->name('siswa.delete');

Route::get('/guru', [App\Http\Controllers\GuruController::class, 'index'])->middleware('auth')->name('guru.index');
Route::post('/guru/store', [App\Http\Controllers\GuruController::class, 'store'])->middleware('auth')->name('guru.store');
Route::get('/guru/edit/{id}', [App\Http\Controllers\GuruController::class, 'edit'])->middleware('auth')->name('guru.edit');
Route::post('/guru/update/{id}', [App\Http\Controllers\GuruController::class, 'update'])->middleware('auth')->name('guru.update');
Route::post('/guru/delete/{id}', [App\Http\Controllers\GuruController::class, 'destroy'])->middleware('auth')->name('guru.delete');


Route::get('/kelas', [App\Http\Controllers\KelasController::class, 'index'])->middleware('auth')->name('kelas.index');
Route::post('/kelas/store', [App\Http\Controllers\KelasController::class, 'store'])->middleware('auth')->name('kelas.store');
Route::get('/kelas/edit/{id}', [App\Http\Controllers\KelasController::class, 'edit'])->middleware('auth')->name('kelas.edit');
Route::post('/kelas/update/{id}', [App\Http\Controllers\KelasController::class, 'update'])->middleware('auth')->name('kelas.update');
Route::post('/kelas/delete/{id}', [App\Http\Controllers\KelasController::class, 'destroy'])->middleware('auth')->name('kelas.delete');

Route::get('/jurusan', [App\Http\Controllers\JurusanController::class, 'index'])->middleware('auth')->name('jurusan.index');
Route::post('/jurusan/store', [App\Http\Controllers\JurusanController::class, 'store'])->middleware('auth')->name('jurusan.store');
Route::get('/jurusan/edit/{id}', [App\Http\Controllers\JurusanController::class, 'edit'])->middleware('auth')->name('jurusan.edit');
Route::post('/jurusan/update/{id}', [App\Http\Controllers\JurusanController::class, 'update'])->middleware('auth')->name('jurusan.update');
Route::post('/jurusan/delete/{id}', [App\Http\Controllers\JurusanController::class, 'destroy'])->middleware('auth')->name('jurusan.delete');
