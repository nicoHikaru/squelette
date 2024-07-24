<?php
namespace App\Controller\Pages;

use Config\Twig\Twig;
//use Psr\Http\Message\ResponseInterface as Response;
//use Psr\Http\Message\ServerRequestInterface as Request;
use Config\Attributes\Route;
use App\Service\Xlsx\ExcelService;


use Config\Abstract\AbstractController;


class FormFile extends AbstractController
{

    public function __construct(private ExcelService $excelService){}


    #[Route(path:'/formFile',name:'formFile',method: 'GET')]
    public function render():string
    {   
        
        
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($this->pathUploadFile().'exemple.xlsx');

        $sheetcount = $spreadsheet->getSheetCount();
        
        $dataSheet = \App\Tools\Sheet::getSheetDataByPage($spreadsheet,$sheetcount);
        //dump($dataSheet);

        $title = \App\Tools\Sheet::getTitleXlsx($dataSheet);
        $content = \App\Tools\Sheet::getContentXlsx($dataSheet);
        $nameFile = "exemple.xlsx";
        $this->excelService->setFile($nameFile,$title,$content);

        $dataSpreadSheet = \App\Tools\Sheet::getDataSheet($spreadsheet,$sheetcount);
       
        //$target_dir         = 'save.xlsx';
        //$worksheet1 = $spreadsheet->getActiveSheet();
        // Create a new Worksheet (Sheet2) and make that the Active Worksheet
        //$worksheet2 = $spreadsheet->createSheet();
        
        //$worksheet1->setCellValue('A3', 'I am a cell on Sheet1');//possible de faire une boucle pour inseret data

        //$worksheet2->setCellValue('A1', 'I am a cell on Sheet2');
        //$writer = new  \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        //$writer->save($this->pathUploadFile().$target_dir);

        
        $twig = Twig::twigInterface();

        return $twig->render($this->pathViews().'form/formFile.html.twig',[
            "dataSpreadSheet" => $dataSpreadSheet,
        ]);
    }
}
