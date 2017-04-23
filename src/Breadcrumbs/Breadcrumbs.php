<?php

namespace Glissmedia\Breadcrumbs;

use Illuminate\Support\Facades\Request;

class Breadcrumbs {

    protected $dir;

    public function __construct()
    {
        $this->dir = realpath(base_path()) . '/resources/views/vendor/breadcrumbs/';
    }

    public function render($data=false, $path=false)
    {

        if(empty($data)){return false;}

        $html = $this->getHtml($data, $path);
        return $html;

    }

    protected function getHtml($data, $template=false)
    {

        $host = Request::server('REQUEST_SCHEME') . '://' . Request::getHost();

        $breadcrumbs = array();
        $i = 0;
        foreach($data as $key=>$b){
            if(config('breadcrumbs.first') === true) {
                $breadcrumbs[$i]['link'] = $i == 0 ? $host : $breadcrumbs[$i - 1]['link'] . $key;
                $breadcrumbs[$i]['title'] = $b;
            }else{
                if($i != 0) {
                    $breadcrumbs[$i]['link'] = $i == 1 ? $host . $key : $breadcrumbs[$i - 1]['link'] . $key;
                    $breadcrumbs[$i]['title'] = $b;
                }
            }

            $i++;
        }

        if(empty($template) || !isset($template)){
            $path = $this->dir . 'default.blade.php';
            return view()->file($path, [
                'data' => $breadcrumbs,
                'separator_content' => config('breadcrumbs.separator.content'),
                'separator_class' => config('breadcrumbs.separator.class')
            ]);
        }else{
            $path = $this->dir . '/' . $template . '.blade.php';
            return view()->file($path, [
                'data' => $breadcrumbs,
                'separator_content' => config('breadcrumbs.separator.content'),
                'separator_class' => config('breadcrumbs.separator.class')
            ]);
        }

    }

}