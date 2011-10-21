<?php
/**
 *
 */
class View
{
    /**
     * Parse view
     *
     * @param string    $view
     * @param array     $args
     * @return void
     */
    public static function factory( $view, array $args = array() )
    {
        $content = '';
        $file = APPPATH . '/view/' . $view . '.php';
        if ( file_exists( $file ) )
        {
            extract($args);

            ob_start();
            include $file;
            return ob_get_clean();
        }
        else
        {
            throw new ExceptionView('File not found: "' . $view . '"');
        }
    }
}
