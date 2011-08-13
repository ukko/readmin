<?php

class View 
{
    /**
     * Display view file
     * @param string    $view
     * @param array     $args
     */
    public static function factory($view, array $args = array())
    {
        $content = '';
        $file = APPPATH . '/view/' . $view . '.php';
        if (file_exists($file)) {
            extract($args);
            
            ob_start();
            include $file;
            return ob_get_clean();
        } else {
            die("view '{$file}' not found");
        }
    }
}