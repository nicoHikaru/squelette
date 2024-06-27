<?php

namespace App\Controller\Pages;

//use Config\Twig\Twig;
use Config\Attributes\Route;
use App\Service\Users\UserService;
use Config\Abstract\AbstractController;
//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;

class GetData extends AbstractController
{
    public function __construct(private UserService $userService){}


    #[Route(path:'/getData',name: 'getData',method: 'GET')]
    public function render()
    {
        $users = $this->userService->getUsersWithMoyenne();
        !$users ? $users = [] : '';
        return json_encode($users);
    }
    
}