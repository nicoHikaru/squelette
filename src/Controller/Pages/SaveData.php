<?php


namespace App\Controller\Pages;

use Config\Attributes\Route;
use App\Service\Users\UserService;
use Config\Abstract\AbstractController;
use App\Service\Moyenne\MoyenneService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SaveData extends AbstractController
{
    public function __construct(
        private UserService $userService,
        private MoyenneService $moyenneService,
    ){}

    #[Route(path:'/saveData',name: 'saveData',method: 'POST')]
    public function render(Request $request,Response $response)
    {
       
        $name = $request->getParsedBody()[0]['name'];
        $surname = $request->getParsedBody()[0]['surname'];
        $moyenne = $request->getParsedBody()[0]['moyenne'];
        $note1 = $request->getParsedBody()[0]['note1'];
        $note2 = $request->getParsedBody()[0]['note2'];

        $regex = '/^[a-zA-Z|\s]+$/';
        $valideName = preg_match($regex,$name);
        $valideSurname = preg_match($regex,$surname);
        
        if(!$valideName || !$valideSurname) {
            throw new \Exception('Nom et prénom invalide.');
            return;
        }
        
        if($note1 < 0 || $note2 < 0) {
            throw new \Exception('Les notes ne peuvent être négatifs.');
            return;
        }

        if($note1 > 20 || $note2 > 20) {
            throw new \Exception('Vous ne pouvre saisir un nombre superieur à 20.');
            return;
        }
        
        $users = $this->userService->setUsers($name,$surname);

        if(gettype($moyenne) == "integer" || gettype($moyenne) == "double" ) {
            $this->moyenneService->setMoyenne($users['id'],$moyenne);
        } else {
            throw new \Exception('Les notes doivent être un nombre.');
        }

        return json_encode([$response]);
    }
}