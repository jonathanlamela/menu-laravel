<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminPerPage extends Component
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
        return view('components.admin-per-page', [
            "options" => [2, 5, 10, 20, 50],
            "selected" => request('perPage', 5)
        ]);
    }
}
