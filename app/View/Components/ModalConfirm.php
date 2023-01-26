<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalConfirm extends Component
{
    public $id, $text, $url, $method;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $text, $url, $method = null)
    {
        $this->id     = $id;
        $this->text   = $text;
        $this->url    = $url;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-confirm');
    }
}
