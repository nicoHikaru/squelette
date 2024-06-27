<?php

namespace App\Controller\Security;

use Config\Twig\Twig;
use Config\Attributes\Route;
use Config\Abstract\AbstractController;
//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;

class Register extends AbstractController
{
    #[Route(path:'/register',name:'register',method:'GET')]
    public function render()
    {
        if($this->getUser() && count($this->getUser()) > 0) {
            //$args = ['name'];
            $twig = Twig::twigInterface();
            return $twig->render($this->pathViews().'register.html.twig',['name' => 'toto']);
        }
    }
}