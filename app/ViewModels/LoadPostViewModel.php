<?php

namespace App\ViewModels;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class LoadPostViewModel extends ViewModel
{
    public $posts;

    public function __construct($posts = []){
        $this->posts = $posts;
    }
    
    public function post_config($posts){
        $this->article_max = config('web.ARTICLE_MAX'); //panjang maksimal artikel
        return collect($posts)->map(function($post){
            $img_loc = General::getNewsPhoto($post['created_at'], $post['slug']);
            $article = (strlen($post['article']) <= $this->article_max) ? $post['article'] : substr($post['article'], 0, $this->article_max) . '...';

            return collect($post)->merge([
                'hero_image-l'  => 'img/news/'.$img_loc.'/3x_'.$post['hero_image'],
                'hero_image-m'  => 'img/news/'.$img_loc.'/2x_'.$post['hero_image'],
                'created_at'    => General::indonesia_date($post['created_at']),
                'article'       => $article,
            ])->except('division_id', 'viewed');
        });
    }

    public function posts(){
        $delay = 150;

        for($i=0;$i<count($this->posts);$i++){
            $this->posts[$i]['delay'] = $delay;

            $delay = ($delay >= 450) ? 150 : $delay += 150;
        }

        return $this->post_config($this->posts);
    }
}
