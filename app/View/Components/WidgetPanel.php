<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WidgetPanel extends Component
{
    public  $color, $title, $count, $icon;

    public function __construct($color, $title, $count, $icon)
    {
        $this->color = $color;
        $this->title = $title;
        $this->count = $count;
        $this->icon  = $icon;
    }

    public function render()
    {
        return view('components.widget-panel');
    }
}
