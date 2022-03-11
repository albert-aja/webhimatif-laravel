<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class WebDivisiViewModel extends ViewModel
{
    public $division;
    public $commitees;
    public $programs;
    public $periode;

    public function __construct($division, $commitees, $programs, $periode){
        $this->division     = $division;
        $this->commitees    = $commitees;
        $this->programs     = $programs;
        $this->periode      = $periode;
    }

    public function title(){
		if($this->division['alias'] == 'BPH'){
			$title = $this->division['division'];
		} else {
			$title = 'Divisi ' .$this->division['division'];
		}

        return $title;
    }

    public function commitees(){
        $delay = 150;

        for($i=0;$i<count($this->commitees);$i++){
            $this->commitees[$i]['delay'] = $delay;

            $delay = ($delay >= 450) ? 150 : $delay += 150;
        }

        return collect($this->commitees)->map(function($commitee){
            $photo = "img/divisi/" .$this->division['slug']. "/". $commitee['photo']. "/" .$commitee['photo'];

            //mengambil ukuran dari tiap" gambar pengurus
            $size = getimagesize("./" .$photo);

            /**
             * Mengakali perbedaan ukuran foto dengan memberikan width yang sesuai dengan ukuran dimensi (w x h)
             * Tujuan : untuk memastikan seluruh foto pengurus tertata dengan rapi
             * 
             * =================================
             * |   rumus : width/height * 34   |
             * ================================
             * 
             * width    : luas foto
             * height   : tinggi foto
             * 34       : nilai konstanta yang ditetapkan
             */
            $width = $size[0] / $size[1] * 34;

            $div = ($this->division['alias'] != 'BPH') ? ' ' . $this->division['alias'] : '';

            $position = $commitee->position['position']. '' . $div . ' ' . $this->periode['year'];

            return collect($commitee)->merge([
                'photo'         => $photo,
                'photo_width'   => $width,
                'position'      => $position
            ]);
        });
    }

    public function programs(){
        $delay = 75;

        for($i=0;$i<count($this->programs);$i++){
            $this->programs[$i]['delay'] = $delay;

            $delay += 75;
        }
        
        return $this->programs;
    }
}
