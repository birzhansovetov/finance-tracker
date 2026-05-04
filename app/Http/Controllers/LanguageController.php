<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        $allowed = ['en', 'ru', 'kk'];

        if (in_array($locale, $allowed)) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }
}