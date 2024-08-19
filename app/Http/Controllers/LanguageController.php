<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        
        if (in_array($locale, ['en', 'ar', 'ur'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
        return redirect()->back();
    }

    public function setLang(Request $request)
{
    // Get the requested language or fall back to the default locale
    $locale = $request->get('lang', config('app.locale'));

    // Retrieve the list of available languages from the configuration
    $availableLocales = config('app.available_locales', ['en', 'ar', 'ur']);

    // Check if the requested language is in the list of available languages
    if (in_array($locale, $availableLocales)) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }

    // Redirect back to the previous page
    return redirect()->back();
}
}
