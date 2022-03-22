<?php

namespace App\ViewModels;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class SearchPostViewModel extends ViewModel
{
    public $results;
    public $query;

    public function __construct($results, $query){
        $this->results      = $results;
        $this->query        = $query;
        $this->max          = 45;
    }

    public function results(){
        return collect($this->results)->map(function($result){
            $title = $result['title'];
            $img_loc = General::getNewsPhoto($result['created_at'], $result['slug']);

            //potong judul apabila kepanjangan
            $show_title = (strlen($title) <= $this->max) ? $title : substr($title, 0, $this->max) . '...';

            //highlight keyword yang dicari
            $marked_title = preg_filter('/' .preg_quote($this->query, '/'). '/i', '<b>$0</b>', $show_title);

            return collect($result)->merge([
                'hero_image'    => 'img/news/' .$img_loc. '/3x_' .$result['hero_image'],
                'marked_title'  => $marked_title,
                'date'          => General::indonesia_date($result['created_at'])
            ])->except('division_id', 'viewed');
        });
    }
}
