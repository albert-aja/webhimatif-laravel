<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatatablePage extends Component
{
    public $page;
    public $route;
    public $title;
    public $breadcrumb;
    public $tableID;

    public function __construct($page, $route, $title, $breadcrumb, $tableID){
        $this->page         = $page;
        $this->route        = $route;
        $this->title        = $title;
        $this->breadcrumb   = $breadcrumb;
        $this->tableID      = $tableID;
    }

    public function render(){
        return view('components.datatable-page');
    }
}
