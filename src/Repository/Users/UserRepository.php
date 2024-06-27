<?php

namespace App\Repository\Users;
use PDO;
use Config\Bdd\Bdd;

class UserRepository
{
    public function __construct()
    {
        
    }
    public function getUser(int $id):array | bool
    {
       
        $pdo = bdd::pdo();
        $sql = "SELECT * FROM USERS WHERE id=:id";
        $bdd = $pdo?->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['id' => $id]);
        $user = $bdd?->fetch(\PDO::FETCH_ASSOC);
        
        return $user;
    }

    public function getUseByName(string $name):array | bool
    {
       
        $pdo = bdd::pdo();
        $sql = "SELECT * FROM USERS WHERE name = :name";
        $bdd = $pdo?->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['name' => $name]);
        $user = $bdd?->fetch(\PDO::FETCH_ASSOC);
        
        return $user;
    }

    public function getUsersWithMoyenne():array | bool
    {
        $pdo = bdd::pdo();
        $sql = "SELECT users.name,users.surname,moyenne.moyenne as user_moyenne FROM users JOIN moyenne ON moyenne.id_user = users.id ORDER BY users.id DESC";
        $bdd = $pdo?->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute();
        $usersWithMoyenne = $bdd?->fetchAll(\PDO::FETCH_ASSOC);
        
        return $usersWithMoyenne;
    }

    public function SetUser(string $name,string $surname):array
    {
       
        $pdo = bdd::pdo();

        $data = [
            'name' => $name,
            'surname' => $surname,  
        ];
        $sql = "INSERT INTO users (name, surname) VALUES (:name, :surname)";
        $bdd= $pdo->prepare($sql);
        $bdd->execute($data);
        
        $users = $this->getUseByName($name);
        
        return $users;
        
    }
}