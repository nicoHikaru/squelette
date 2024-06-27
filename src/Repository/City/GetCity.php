<?php

namespace App\Repository\City;

use PDO;
use Config\Bdd\Bdd;

class GetCity
{
    //private ?PDO $pdo = Bdd::pdo();

    public function __construct()
    {
        
    }

    private function pdo()
    {
        return Bdd::pdo();;
    }

    public function getCity(int $id):array | null
    {
        
        $sql = "SELECT * FROM city WHERE id=:id";
        $bdd = $this->pdo()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['id' => $id]);
        $city = $bdd?->fetch(\PDO::FETCH_ASSOC);
        
        return $city;
    }

    public function getDepartementOfCity(int $id):array | null
    {
        
        $sql = "
                SELECT 
                    city.name as city_name,
                    departements.name as departement_name 
                FROM city 
                LEFT JOIN departements on city.dep_num = departements.code 
                WHERE city.id = :id
            ";
        $bdd = $this->pdo()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['id' => $id]);
        $city = $bdd?->fetch(\PDO::FETCH_ASSOC);
        
        return $city;
    }

    public function searchCity(?string $search)
    {
        $sql = "
            SELECT city.name as city_name
            FROM city WHERE city.name LIKE concat(:search,'%')
        ";
        $bdd = $this->pdo()->prepare($sql,[PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['search' => $search]);
        $city = $bdd?->fetchAll(PDO::FETCH_ASSOC);

        return $city;
    }

    public function getCityVarOnly(?int $departement)
    {
        $sql = "
            SELECT 
                city.name as city_name, 
                CASE   
                    WHEN city.dep_num = :departement THEN city.dep_num 
                    # WHEN city.dep_num < 20 THEN city.dep_num 
                    ELSE NULL
                END as city_departement
            FROM city 
        ";
        $bdd = $this->pdo()->prepare($sql,[PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['departement' => $departement]);
        $city = $bdd?->fetchAll(PDO::FETCH_ASSOC);

        return $city;
    }
}