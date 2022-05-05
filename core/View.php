<?php
namespace Core;

/**
 * View class
 *
 * @namespace Core
 */
class View{

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $data Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public function render($view, $data = []){
        extract($data);
        require "app/views/{$view}.php";
    }
}