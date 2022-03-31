<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $modalID;
    public $modalSize;
    public $title;

    public function __construct($modalID, $modalSize, $title){
        $this->modalID      = $modalID;
        $this->modalSize    = $modalSize;
        $this->title        = $title;
    }

    public function render()
    {
        return view('components.modal');
    }
}
