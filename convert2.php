<?php
require_once('./vendor/autoload.php');
require_once('./db.inc.php');

$inputFileName = './test3.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
$sheetVar = $spreadsheet->getSheet(0);

$Sql = "INSERT INTO `sake_items` 
                  (`itemName`, `breId`, `riceId`, `vId`, `alcohol`, 
                   `nihonshudo`, `aminosando`, `sando`, `seimaibuai`, `capacity`, 
                   `price`, 
                   `description`, `howTo`, `nearby`) 
           VALUES (?, ?, ?, ?, ?, 
                   ?, ?, ?, ?, ?, 
                   ? ,
                    ?, ?, ? ) ";

for($i = 2; $i <= $highestRow; $i++) {
    if( $sheetVar->getCell('A'.$i)->getValue() === '' || $sheetVar->getCell('A'.$i)->getValue() === null ) break;

    $varParam = [
        $sheetVar->getCell('E'.$i)->getValue(),
        $sheetVar->getCell('D'.$i)->getValue(),
        $sheetVar->getCell('N'.$i)->getValue(),
        $sheetVar->getCell('F'.$i)->getValue(),
        $sheetVar->getCell('K'.$i)->getValue(),

        $sheetVar->getCell('J'.$i)->getValue(),
        $sheetVar->getCell('G'.$i)->getValue(),
        $sheetVar->getCell('H'.$i)->getValue(),
        $sheetVar->getCell('I'.$i)->getValue(),
        $sheetVar->getCell('L'.$i)->getValue(),

        $sheetVar->getCell('M'.$i)->getValue(),
        $sheetVar->getCell('O'.$i)->getValue(),
        $sheetVar->getCell('P'.$i)->getValue(),
        $sheetVar->getCell('Q'.$i)->getValue()
    ];

    $stmtVar = $pdo->prepare($Sql);

    // echo "<pre>";
    // print_r($stmtVar);
    // echo $stmtVar;
    // echo "</pre>";
    // exit;
        
    $stmtVar->execute($varParam);
}