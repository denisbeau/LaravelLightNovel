<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\LocalizationController;


class LocalizationController extends Controller
{
    public function index($locale): RedirectResponse
    {
        $supported = ['fr','en','es']; // langues supportées
        if (!in_array($locale, $supported)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        session(['locale' => $locale]);

        return redirect()->back();
    }
}
