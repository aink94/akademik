<?php

//Dynamically add Javascript files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $js = array();
        if(empty($file)){
            return;
        }

        if(is_array($file)){
            foreach($file AS $item){
                $js[] = $ci->config->item('js')[$item];
            }
            $ci->config->set_item('js',$js);
        }else{
            $str = $file;
            $js[] = $ci->config->item('js')[$str];
            $ci->config->set_item('js',$js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $css = array();
        if(empty($file)){
            return;
        }

        if(is_array($file)){
            foreach($file AS $item){
                $css[] = $ci->config->item('css')[$item];
            }
            $ci->config->set_item('css',$css);
        }else{
            $str = $file;
            $css[] = $ci->config->item('css')[$str];
            $ci->config->set_item('css',$css);
        }
    }
}

if(!function_exists('put_js')){
    function put_js()
    {
        $str = '';
        $ci = &get_instance();
        $js  = $ci->config->item('js');


        foreach($js AS $item){
            $str .= '<script type="text/javascript" src="'.$item.'"></script>'."\n";
        }
        return $str;
    }
}
if(!function_exists('put_css')){
    function put_css()
    {
        $str = '';
        $ci = &get_instance();
        $css  = $ci->config->item('css');


        foreach($css AS $item){
            $str .= '<link rel="stylesheet" href="'.$item.'" type="text/css" />'."\n";
        }
        return $str;
    }
}