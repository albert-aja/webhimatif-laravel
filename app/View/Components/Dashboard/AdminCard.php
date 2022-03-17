<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class AdminCard extends Component
{
    public $bg;
    public $icon;
    public $title;
    public $info;
    public $route;
    
    public function __construct($bg, $icon, $title, $info, $route = false){
        $this->bg       = $bg;
        $this->icon     = $icon;
        $this->title    = $title;
        $this->info     = $info;
        $this->route    = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.admin-card');
    }
}
