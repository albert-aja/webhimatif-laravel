<?php

namespace App\Helpers;

/**
 * Breadcrumb handler helper
 * 
 * A breadcrumb is a type of secondary navigation scheme that reveals the user's location in a website or Web application.
 * 
 * On the user page, the breadcrumb can be found on every page (except the home page) at the bottom of the header title.
 * On the admin page, the breadcrumb can be found on the right side of a header card.
 */
class Breadcrumbs
{
    private $breadcrumbs = [];
    private $tags;

    public function __construct(){
        // true apabila ingin breadcrumb terakhir (halaman yang sedang dikunjungi) adalah sebuah link
        // false apabila tidak
        $this->nonClickable = true;

        // element html
        $this->tags['sectionopen']  = "<div class=\"section-header-breadcrumb\">";
        $this->tags['sectionclose'] = "</div>";
        $this->tags['itemopen']     = "<div class=\"breadcrumb-item\">";
        $this->tags['itemclose']    = "</div>";
    }

    /**
     * Add crumb to breadcrumb array (manual build).
     * 
     * @param string $crumb crumb text
     * @param string $href link url
     */
    public function add(string $crumb, string $href = ''){
        if (!$crumb){
            return;
        } 

        $this->breadcrumbs[] = [
            'crumb' => $crumb,
            'href'  => $href,
        ];
    }

    /**
     * Build the breadcrumb array (manual build).
     * 
     * @return string crumb output
     */
    public function render(){
        $crumbs = $this->tags['sectionopen'];
        $count  = count($this->breadcrumbs) - 1;

        foreach ($this->breadcrumbs as $index => $breadcrumb) {
            if ($index == $count) {
                $crumbs .= $this->tags['itemopen'] . $breadcrumb['crumb'] . $this->tags['itemclose'];
            } else {
                $crumbs .= $this->tags['itemopen'] . '<a href="' . route('home') . $breadcrumb['href'] . '">' . $breadcrumb['crumb'] . '</a>' . $this->tags['itemclose'];
            }
        }

        $crumbs .= $this->tags['sectionclose'];

        return $crumbs;
    }

    /**
     * Auto build user page breadcrumb.
     * 
     * @param bool $useSlug whether there is a slug in the URL. 
     * 
     * @return string crumb output
     */
    public function userCrumb($useSlug = false){
        $crumbs = array_merge(['Home'], request()->segments());

        //remove slug from the crumbs array
        if($useSlug){
            array_pop($crumbs);
        }

        foreach($crumbs as &$crumb){
            $name   = ucwords(str_replace(array(".php", "_"), array("", " "), $crumb));
            $crumb  = ucwords(str_replace('-', ' ', $name));
        }

        return $crumbs;
    }

    /**
     * Auto build admin page breadcrumb.
     * 
     * @return string crumb output
     */
    public function adminCrumb() {
        $output = $this->tags['sectionopen'];
        $crumbs = array_merge(request()->segments());
        $result = array();
        $path   = '';
        $count  = count($crumbs);

        if ($this->nonClickable){
            $count = count($crumbs) -1;
        }

        foreach ($crumbs as $k => $crumb) {
            $path .= '/' . $crumb;

            // shift home page route
            // NB : admin home page is /Admin/Dashboard, not /Admin
            if(strtolower($path) === '/admin'){
                $path = '/Admin/Dashboard';
            }

            $name = ucwords(str_replace(array(".php", "_"), array("", " "), $crumb));
            $name = ucwords(str_replace('-', ' ', $name));

            // shift page name from 'Admin' to 'Home'
            if((strtolower($name)) === 'admin'){
                $name = 'Home';
            }

            if ($k != $count) {
                $result[] = $this->tags['itemopen'] . '<a href="' . $path . '"> ' . $name . '</a>' . $this->tags['itemclose'];
            } else {
                $result[] = $this->tags['itemopen'] . $name . $this->tags['itemclose'];
            }

            // shift back the route
            if(strtolower($path) === '/admin/dashboard'){
                $path = '/Admin';
            }
        }

        $output .= implode($result);
        $output .= $this->tags['sectionclose'];

        return $output;
    }
}
