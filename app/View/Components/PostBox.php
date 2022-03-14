<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostBox extends Component
{
    public $title;
    public $img1;
    public $img2;
    public $date;
    public $article;
    public $slug;

    public function __construct($title, $img1, $img2, $date, $article, $slug){
        $this->title = $title;
        $this->img1 = $img1;
        $this->img2 = $img2;
        $this->date = $date;
        $this->article = $article;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-box');
    }
}
