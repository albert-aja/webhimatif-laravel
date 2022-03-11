<?php

namespace App\ViewModels;

use App\ViewModels\LoadPostViewModel;
use Spatie\ViewModels\ViewModel;

class WebHomeViewModel extends ViewModel
{
    public $missions;
    public $category1;
    public $posts;
    public $divisions;

    public function __construct($missions, $category, $posts, $divisions){
        $this->missions     = $missions;
        $this->category     = $category;
        $this->posts        = $posts;
        $this->divisions    = $divisions;
    }

    public function missions(){
        $delay = 150;

        for($i=0;$i<count($this->missions);$i++){
            $this->missions[$i]['delay'] = $delay;

			$delay += 150;

            if($delay > 300){
                $delay = 150;
            }
        }

        return $this->missions;
    }

    public function category1(){
        return collect($this->category)->take(1)->map(function($ct){
            return collect($ct)->merge([
                'photo' => 'img/web/shop/'.$ct['photo'],
            ]);
        });
    }

    public function category2(){
        return collect($this->category)->skip(1)->take(2)->map(function($ct){
            return collect($ct)->merge([
                'photo' => 'img/web/shop/'.$ct['photo'],
            ]);
        });
    }

    public function posts(){
        $delay = 150;

        for($i=0;$i<count($this->posts);$i++){
            $this->posts[$i]['delay'] = $delay;
			$delay += 150;
        }

        $post = new LoadPostViewModel();

        return $post->post_config($this->posts);
    }

    public function divisions(){
        $nomor = 1;
        $delay = 100;

        for($i=0;$i<count($this->divisions);$i++){
            $this->divisions[$i]['number']  = '0'.$nomor;
            $this->divisions[$i]['delay']   = $delay;
            
            $nomor++;
            $delay+=100;

            if($delay > 300){
                $delay = 100;
            }
        }
        
        return $this->divisions;
    }

    public function youtube(){
        $delay = 150;
        $display = 4;

        $video_arr = [];

        for($i=0;$i<$display;$i++){
            $video_arr[$i]['delay']     = $delay;
            $video_arr[$i]['display']   = $i;

            $delay += 150;
        }

        return $video_arr;
    }
}
