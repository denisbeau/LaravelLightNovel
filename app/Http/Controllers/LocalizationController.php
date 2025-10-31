<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;


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
