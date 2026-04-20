<?php
namespace Core;
use Core\Template;

/**
 * View class
 *
 * @namespace Core
 */
class View{

    function __construct()
    {
        $template = new Template();
    }

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $data Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $data = []){
        extract($data);
        require "app/view/{$view}.php";
    }
}