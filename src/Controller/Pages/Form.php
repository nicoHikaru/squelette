<?php
namespace App\Controller\Pages;

use Config\Twig\Twig;
//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;
use Config\Attributes\Route;

use Config\Abstract\AbstractController;


class Form extends AbstractController
{

    public function __construct(){}


    #[Route(path:'/form',name: 'form',method: 'GET')]
    public function render()
    {   
        $twig = Twig::twigInterface();
        return $twig->render($this->pathViews().'form/form.html.twig');
    }
}
