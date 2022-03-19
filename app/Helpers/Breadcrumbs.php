<?php

namespace App\Helpers;

// Breadcrumbs adalah elemen pada website yang memiliki fungsi sebagai navigasi halaman.
// Pada halaman admin, breadcrumb terletak pada header tiap halaman

class Breadcrumbs
{
    private $breadcrumbs = array();
    private $tags;

    public function __construct(){
        // true apabila ingin breadcrumb terakhir (halaman yang sedang dikunjungi) adalah sebuah link
        // dan false adalah tidak
        $this->nonClickable = true;

        // element html bootstrap
        $this->tags['sectionopen']  = "<div class=\"section-header-breadcrumb\">";
        $this->tags['sectionclose'] = "</div>";
        $this->tags['itemopen']   = "<div class=\"breadcrumb-item\">";
        $this->tags['itemclose']  = "</div>";
    }

    public function add($crumb, $href = ''){
        if (!$crumb){
            return;
        } 

        $this->breadcrumbs[] = array(
            'crumb' => $crumb,
            'href' => $href,
        );
    }


    public function render(){
        $output  = $this->tags['sectionopen'];
        $count = count($this->breadcrumbs) - 1;

        foreach ($this->breadcrumbs as $index => $breadcrumb) {
            if ($index == $count) {
                $output .= $this->tags['itemopen'];
                $output .= $breadcrumb['crumb'];
                $output .= $this->tags['itemclose'];
            } else {
                $output .= $this->tags['itemopen'];
                $output .= '<a href="' . route('home') . $breadcrumb['href'] . '">';
                $output .= $breadcrumb['crumb'];
                $output .= '</a>';
                $output .= $this->tags['itemclose'];
            }
        }

        $output .= $this->tags['sectionclose'];

        return $output;
    }

    public function buildAuto($useSlug = false){
        $crumbs = ['Home'];

        $crumbs = array_merge($crumbs, request()->segments());

        if($useSlug){
            array_pop($crumbs);
        }

        foreach($crumbs as &$crumb){
            $name = ucwords(str_replace(array(".php", "_"), array("", " "), $crumb));
            $crumb = ucwords(str_replace('-', ' ', $name));
        }

        return $crumbs;
    }

    public function buildAutoTag() {
        $output  = $this->tags['sectionopen'];

        $crumbs = array_merge(request()->segments());

        $result = array();
        $path = '';

        $count = count($crumbs);

        // -1 apabila link terakhir bukan merupakan link
        if ($this->nonClickable){
            $count = count($crumbs) -1;
        }

        foreach ($crumbs as $k => $crumb) {
            $path .= '/' . $crumb;

            //mengakali halaman home pada Admin Page
            // NB : Halaman home admin adalah /Admin/Dashboard, bukan /Admin
            if(strtolower($path) === '/admin'){
                $path = '/Admin/Dashboard';
            }

            $name = ucwords(str_replace(array(".php", "_"), array("", " "), $crumb));
            $name = ucwords(str_replace('-', ' ', $name));

            //Mengakali nama halaman 'Admin' menjadi 'Home'
            if((strtolower($name)) === 'admin'){
                $name = 'Home';
            }

            if ($k != $count) {
                $result[] = $this->tags['itemopen'] . '<a href="' . $path . '"> ' . $name . '</a>' . $this->tags['itemclose'];
            } else {
                $result[] = $this->tags['itemopen'] . $name . $this->tags['itemclose'];
            }

            //memperbaiki link untuk breadcrumb seterusnya
            if(strtolower($path) === '/admin/dashboard'){
                $path = '/Admin';
            }
        }

        $output .= implode($result);
        $output .= $this->tags['sectionclose'];

        return $output;
    }
}
