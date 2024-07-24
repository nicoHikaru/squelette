<?php


namespace App\Service\Xlsx;

use App\Repository\Xlsx\ExcelRepository;


class ExcelService
{
    public function __construct(private ExcelRepository $excelRepository){}

    public function getFile():array | bool
    {
        return $this->excelRepository->getFile();
    }

    public function setFile(string $name,array $title,array $content):void
    {

        $fileId = $this->excelRepository->setFile($name);
        
        $titleId = [];
        foreach($title as $key => $sheet) {
            $titleId[] = $this->excelRepository->setTitle($sheet,$fileId,$key);
        }
        
        foreach($content as $key => $sheet) {
            $this->setContent($sheet,$titleId[$key]);
        }
       
        
    }

    public function setContent(array $sheet,array $titleId):void
    {
        foreach($sheet as $content) {
            $this->excelRepository->setContent($content,$titleId);
        }
    }
}

