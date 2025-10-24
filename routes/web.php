<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LightNovelController;
use App\Http\Controllers\CommentaireController;
// use App\Http\Controllers\ArticleController; // <-- commenter si ArticleController n'existe pas

// Route d'autocomplete pour les light_novels (assure-toi que la méthode existe dans LightNovelController)
Route::get('/light_novels/autocomplete', [LightNovelController::class, 'autocomplete'])->name('light_novels.autocomplete');

// Si tu veux garder la route articles mais que le contrôleur n'existe pas, commente la ligne suivante:
// Route::get('/articles/autocomplete', [ArticleController::class, 'autocomplete'])->name('articles.autocomplete');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('light_novels', LightNovelController::class);
Route::resource('commentaires', CommentaireController::class);
Route::get('/users/autocomplete', [UserController::class, 'autocomplete'])->name('users.autocomplete');
