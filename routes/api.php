<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomesController;

Route::resource('receitas', IncomesController::class);

Route::resource('despesas', ExpensesController::class);

Route::resource('categorias', CategoryController::class);

