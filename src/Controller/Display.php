<?php
namespace App\Controller;

use App\Router;

class Display
{
    /**
     * display all route
     */
    public static function render():void
    {
        Router::render();
    }
}