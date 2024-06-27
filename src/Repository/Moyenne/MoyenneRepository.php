<?php


namespace App\Repository\Moyenne;

use Config\Bdd\Bdd;

class MoyenneRepository
{
    public function getAll()
    {
        //..
    }

    public function setMoyenne(int $id_user,float $moyenne):void
    {
        $pdo = bdd::pdo();

        $data = [
            'id_user' => $id_user,
            'moyenne' => $moyenne,  
        ];
        $sql = "INSERT INTO moyenne (id_user, moyenne) VALUES (:id_user, :moyenne)";
        $bdd= $pdo->prepare($sql);
        $bdd->execute($data);
    }
}
