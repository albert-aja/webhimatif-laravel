<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class CollapseHeader extends Component
{
    public $targetID;
    public $title;

    public function __construct($targetID, $title){
        $this->targetID = $targetID;
        $this->title = $title;
    }

    public function render(){
        return view('components.dashboard.collapse-header');
    }
}
