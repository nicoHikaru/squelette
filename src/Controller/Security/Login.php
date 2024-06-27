<?php

namespace App\Controller\Security;

//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;

use Config\Abstract\AbstractController;
use Config\Attributes\Route;
use Config\Attributes\Role;
use Config\Twig\Twig;

class Login extends AbstractController
{
    #[
        Route(path:'/login',name:'login',method:'GET'),
        Role(role:'USER')
    ]
    public function render()
    {
        if($this->getUser() && count($this->getUser()) > 0) {
            //$args = ['name'];
            $twig = Twig::twigInterface();
            return $twig->render($this->pathViews().'login/login.html.twig',['name' => 'titi']);
        }
    }
}