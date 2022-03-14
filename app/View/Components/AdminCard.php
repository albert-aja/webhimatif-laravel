<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminCard extends Component
{
    public $icon;
    public $title;
    public $data;
    public $route;
    
    public function __construct($icon, $title, $data, $route){
        $this->icon     = $icon;
        $this->title    = $title;
        $this->data     = $data;
        $this->route    = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-card');
    }
}
