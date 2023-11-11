<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminOrderToggler extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $class, public string $label, public string $field)
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
        return view('components.admin-order-toggler', [
            'isCurrent' => request('orderBy', 'id') == $this->field,
            'ascending' => request('ascending', true)
        ]);
    }
}
