<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\FrontpagesController;
use App\Http\Controllers\DeleteHandlerController;



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

Route::get('/',[FrontpagesController::class,'index'])->name('index')->middleware('auth');
Route::prefix('create')->name('create.')->middleware('auth')->group(function(){
    Route::get('/system',[SystemController::class,'CreateSystemPage'])->name('system');
    Route::post('/create-system',[SystemController::class,'store'])->name('system.store');
    Route::post('/system-logo',[SystemController::class,'UpdateLogo'])->name('UpdateLogo');
    Route::get('/system-logo/{id}',[SystemController::class,'addlogo'])->name('systemlogo');
    Route::get('/note',[NoteController::class,'CreateNotesPage'])->name('note');
    Route::post('/create-note',[NoteController::class,'store'])->name('note.store');
});
Route::prefix('update')->name('update.')->middleware('auth')->group(function(){
    Route::get('/system/{id}',[SystemController::class,'updatepage'])->name('system');
    Route::get('/note/{id}',[NoteController::class,'updatepage'])->name('system');
});
Route::prefix('delete')->name('delete.')->middleware('auth')->group(function(){
    Route::delete('/system',[SystemController::class,'delete'])->name('system');
    Route::get('/confirm-delete/{table}/{id}',[DeleteHandlerController::class,'delete'])->name('confirm');
});
Route::middleware('guest')->name('auth.')->group(function(){
    Route::get('/signin',[AuthController::class,'signinpage'])->name('signinpage');
    Route::post('/auth-signin',[AuthController::class,'signin'])->name('signin');
    Route::post('/auth-signup',[AuthController::class,'signup'])->name('signup');
    Route::get('/signup',[AuthController::class,'signuppage'])->name('signuppage');
});
Route::name('pages.')->middleware('auth')->group(function(){
    Route::get('/my-institutions',[FrontpagesController::class,'myInstitutions'])->name('myInstitutions');
    Route::get('/note/{id}',[FrontpagesController::class,'note'])->name('note');
    Route::get('/institution/{name}',[FrontpagesController::class,'institution'])->name('institution');
});
