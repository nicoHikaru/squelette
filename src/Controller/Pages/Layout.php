<?php
namespace App\Controller\Pages;

use Config\Twig\Twig;

class Layout
{
    public static function render()
    {
        $twig = Twig::twigInterface();
        return $twig->render('base.html.twig',[
            
        ]);
        
    }
}
