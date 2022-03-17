<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class DashboardChart extends Component
{
    public $title;
    public $canvasID;

    public function __construct($title, $canvasID){
        $this->title = $title;
        $this->canvasID = $canvasID;
    }

    public function render(){
        return view('components.dashboard.dashboard-chart');
    }
}
