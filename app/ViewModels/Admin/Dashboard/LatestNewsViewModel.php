<?php

namespace App\ViewModels\Admin\Dashboard;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class LatestNewsViewModel extends ViewModel
{
    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function latestNews(){
        $this->article_max = 100; //panjang maksimal artikel
        return collect($this->data)->map(function($dt){
            $article = (strlen($dt['article']) <= $this->article_max) ? $dt['article'] : substr($dt['article'], 0, $this->article_max) . '...';

            return collect($dt)->merge([
                'hero_image'    => 'img/news/hero_image/3x_' .$dt['hero_image'],
                'created_at'    => General::indonesia_date($dt['created_at']),
                'article'       => $article,
            ])->except('division_id', 'viewed');
        });
    }
}
