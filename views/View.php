<?php
class View {
    
    function __construct() {
        //echo 'view';
    }
    
    public function render($name)
    {
        require 'views/' . $name . '.php';
    }
    
}