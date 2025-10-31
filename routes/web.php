<?php
use App\Http\Controllers\LocalizationController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\LightNovelController;
use App\Http\Controllers\CommentaireController;
// use App\Http\Controllers\ArticleController; // <-- commenter si ArticleController n'existe pas

// Route d'autocomplete pour les light_novels (assure-toi que la méthode existe dans LightNovelController)
Route::get('/light_novels/autocomplete', [LightNovelController::class, 'autocomplete'])->name('light_novels.autocomplete');

// Si tu veux garder la route articles mais que le contrôleur n'existe pas, commente la ligne suivante:
// Route::get('/articles/autocomplete', [ArticleController::class, 'autocomplete'])->name('articles.autocomplete');

Route::get('/', function () {
    return redirect('/light_novels');
});

Route::get('/lang/{locale}', [LocalizationController::class, 'index']);

// Admin area - protected by auth + administrateur middleware
Route::middleware(['auth', 'administrateur'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
});

Route::resource('light_novels', LightNovelController::class);
Route::resource('commentaires', CommentaireController::class);
Route::get('/light_novels/autocomplete', [App\Http\Controllers\LightNovelController::class, 'autocomplete'])->name('light_novels.autocomplete');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/email/verify', function (): Factory|View {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request): Redirector|RedirectResponse {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request): RedirectResponse {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/about', function () {
    return view('about');
})->name('about');