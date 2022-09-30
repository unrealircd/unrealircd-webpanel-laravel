<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __invoke(string $language)
    {
        if(in_array($language, ['en', 'tr', 'es'])) {
            session()->put('_lang', $language);

            app()->setLocale($language);
            session()->flash('message', [
                'type' => 'success',
                'title' => __('Success!'),
                'message' => __("Your language has been updated.")
            ]);

            return redirect()->back();
        }

        session()->flash('message', [
            'type' => 'danger',
            'title' => __('Error'),
            'message' => __("That language is not supported.")
        ]);

        return redirect()->back();
    }
}
