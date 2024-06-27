<?php
namespace App\Controller\Pages;

use App\Service\City\CityInformation;
use Config\Twig\Twig;
//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;
use Config\Attributes\Route;
use App\Service\Comment\GetComment;
use App\Service\Users\UserService;
use Config\Abstract\AbstractController;


class Home extends AbstractController
{

    public function __construct(
        private UserService $userService,
        private GetComment $getComment,
        private CityInformation $cityInformation,
    ){}


    #[Route(path:'/',name: 'home',method: 'GET')]
    public function render()
    {
       
        $users = $this->userService->getUsers(1);
        $city = $this->cityInformation->getDepartement(2);
        $result = $this->cityInformation->searchCity("la");
        
        $cityVarOnly = $this->cityInformation->getCityVarOnly(83);
        $cvo = array_filter($cityVarOnly,function($e) {
            return $e['city_departement'] !== null;
        });
        
        $twig = Twig::twigInterface();
        return $twig->render($this->pathViews().'/home/home.html.twig',[
            'name' => 'home',
            'users' => $users,
            'city' => $city,
            'result' => $result,
            'cityVarOnly' => $cvo,
        ]);
    }
}
