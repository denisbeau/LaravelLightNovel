<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LightNovelController;
use App\Http\Controllers\CommentaireController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned
| to the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Resource routes — un appel par ressource (nom, contrôleur)
Route::resource('light_novels', LightNovelController::class);
Route::resource('commentaires', CommentaireController::class);
