<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;


Route::get('/', function () {
    return view('welcome');
});




Route::resource('accounts', AccountController::class);
Route::post('accounts/{id}/renew', [AccountController::class, 'renew'])->name('accounts.renew');