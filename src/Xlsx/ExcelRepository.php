<?php

namespace App\Repository\Xlsx;


use PDO;
use Config\Bdd\Bdd;

class ExcelRepository
{
    public function __construct(){}


    public function getFile():array | bool
    {
       
        $pdo = bdd::pdo();
        $sql = "SELECT * FROM file WHERE id=:id";
        $bdd = $pdo?->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute([]);
        $user = $bdd?->fetch(\PDO::FETCH_ASSOC);
        
        return $user;
    }

   /*  public function getXlsx(int $id):array | bool
    {
       
        $pdo = bdd::pdo();
        $sql = "SELECT * FROM USERS WHERE id=:id";
        $bdd = $pdo?->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $bdd?->execute(['id' => $id]);
        $user = $bdd?->fetch(\PDO::FETCH_ASSOC);
        
        return $user;
    } */

    

    public function setFile(string $name):?int
    {
       
        $pdo = bdd::pdo();

        $data = [
            'name' => $name,
        ];
        $sql = "INSERT INTO file (name) VALUES (:name)";
        $bdd= $pdo->prepare($sql);
        $bdd->execute($data);
        
        return $pdo->lastInsertId();
        
    }

    public function setTitle(array | null $sheet,int $fileId,string $page)
    {
        $pdo = bdd::pdo();
        $idTitle = [];
       
        if($sheet === null) {
            $data = [
                'title' => $sheet,
                'fileId' => $fileId,
                'sheet' => $page,
            ];
            $sql = "INSERT INTO title (name,file_id,sheet) VALUES (:title,:fileId,:sheet)";
            $bdd= $pdo->prepare($sql);
            $bdd->execute($data);
            $idTitle[] = $pdo->lastInsertId();
        }


        foreach($sheet as $title)
        {
            
            $data = [
                'title' => $title,
                'fileId' => $fileId,
                'sheet' => $page,
            ];
            $sql = "INSERT INTO title (name,file_id,sheet) VALUES (:title,:fileId,:sheet)";
            $bdd= $pdo->prepare($sql);
            $bdd->execute($data);
            $idTitle[] = $pdo->lastInsertId();
        }

        return $idTitle;
        
    }

    public function setContent(array | null $contentBySheet,array $titleId):void
    {
        $pdo = bdd::pdo();
        

        foreach($contentBySheet as $key => $content)
        {
            
            $data = [
                'name' => $content,
                'titleId' => (int)$titleId[$key],
            ];
            $sql = "INSERT INTO content (name,id_title) VALUES (:name,:titleId)";
            $bdd= $pdo->prepare($sql);
            $bdd->execute($data);
        }
        
    }
}