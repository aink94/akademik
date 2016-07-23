<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
if( ! function_exists('js'))
{
    function js($src = '', $type = 'text/javascript', $newline = "\n")
    {
        if ( ! is_array($src))
        {
            $src = array(array('src' => $src, 'type' => $type, 'newline' => $newline));
        }
        else
        {
            if (isset($src['src']))
            {
                $src = array($src);
            }
        }
        
        $str = '';
        foreach($src as $js)
        {
            $src       = ( ! isset($js['src']))     ? '' : $js['src'];
            $type      = ( ! isset($js['type']))    ? 'text/javascript' : $js['type'];
            $newline   = ( ! isset($js['newline']))	? "\n"	: $js['newline'];
            
            $str  .= '<script src="'.$src.'" type="'.$type.'" ></script>'.$newline;
        }
        return $str;
    }
}
//<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
if ( ! function_exists('css'))
{
    function css($href = '', $rel = 'stylesheet', $type = 'text/css', $newline = "\n")
    {
       if ( ! is_array($href))
        {
            $href = array(array('href' => $href, 'rel' => $rel, 'type' => $type, 'newline' => $newline));
        }
        else
        {
            if (isset($href['href']))
            {
                $href = array($href);
            }
        }
        
        $str = '';
        foreach($href as $css)
        {
            $href      = ( ! isset($css['href']))     ? '' : $css['href'];
            $rel       = ( ! isset($css['rel']))      ? 'stylesheet' : $css['type'];
            $type      = ( ! isset($css['type']))     ? 'text/css' : $css['type'];
            $newline   = ( ! isset($css['newline']))  ? "\n"	: $css['newline'];
            
            $str  .= '<link href="'.$href.'" rel="'.$rel.'" type="'.$type.'" />'.$newline;
        }
        return $str;
    }
}