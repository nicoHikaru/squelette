<?php

namespace App\Tools;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Sheet
{
    public static function getSheetDataByPage(Spreadsheet $spreadsheet,int $sheetcount):array
    {
        $sheetData = [];
        for($i = 0 ; $i < $sheetcount ; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $sheetData[] = $sheet->toArray(null,true,true,false,false);
            self::setSheetDataByPage($sheetData);
        }
        return $sheetData;
    }

    public static function setSheetDataByPage(array $sheetData):void
    {
        //dd($sheetData);
        //ici on insert dans la base de données sheetData
    }

    public static function getDataSheet(Spreadsheet $spreadsheet):array
    {
        $sheet = $spreadsheet->getActiveSheet();
        $dataSpreadSheet = [];
        for($letter = 'A1' ; $letter < 'Z' ; $letter++) {
            $lsValue = $sheet->getCell($letter)->getValue();
            if($lsValue !== null) {
                $dataSpreadSheet[] = $lsValue;
            }
        }

        return $dataSpreadSheet;
    }
}