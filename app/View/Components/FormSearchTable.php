<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSearchTable extends Component
{
    public $url, $request;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $request)
    {
        $this->url     = $url;
        $this->request = $request;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-search-table');
    }
}
