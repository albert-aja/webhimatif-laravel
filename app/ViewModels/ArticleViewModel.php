<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

use App\Helpers\General;
use App\ViewModels\LoadPostViewModel;

class ArticleViewModel extends ViewModel
{
    public $article;
    public $latest;

    public function __construct($article, $latest){
        $this->article = $article;
        $this->latest   = $latest;
    }

    public function article(){
        return collect($this->article)->merge([
            'hero_image-l'  => 'img/news/hero_image/1x_' .$this->article['hero_image'],
            'hero_image-m'  => 'img/news/hero_image/3x_' .$this->article['hero_image'],
            'date'          => General::indonesia_date($this->article['created_at']),
            'readtime'      => General::readingTime($this->article['article'])
        ])->except('division_id', 'viewed');
    }

    public function latest(){
        $post = new LoadPostViewModel();

        return $post->post_config($this->latest);
    }

    public function viewers(){
        return $this->article['viewed'] + 1;
    }
}
