<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\App;

class LanguageSelector extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.language-selector', [
            "languages" => [
                [
                    "label" => "Italiano",
                    "code" => "it"
                ],
                [
                    "label" => "English",
                    "code" => "en"
                ],
            ],
            "currentLang" => session('language', 'it')
        ]);
    }
}
