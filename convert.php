<?php
require_once('./vendor/autoload.php');
require_once('./db.inc.php');

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');
// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');
// $cellValue = $spreadsheet->getActiveSheet()->getCell('A1')->getValue();
// echo $cellValue;


$inputFileName = './test2.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

// echo "<pre>";
// print_r($inputFileName);
// echo $inputFileName;
// echo "</pre>";
// exit;

$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
// $sheetRegions = $spreadsheet->getSheet(0);
// $sheetPrefectures = $spreadsheet->getSheet(1);
// $sheetBreweries = $spreadsheet->getSheet(2);
// $sheetItems = $spreadsheet->getSheet(0);
// $sheetItems = $spreadsheet->getSheet(0);
// $sheetRice = $spreadsheet->getSheet(2);
$sheetVar = $spreadsheet->getSheet(1);


// echo "Sheet Count: ".$spreadsheet->getSheetCount().
// "<br>";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetRegions->getCell('A'.$i)->getValue() === '' || $sheetRegions->getCell('A'.$i)->getValue() === null ) break;

//     echo "rId: ".$sheetRegions->getCell('A'.$i)->getValue()." / ".
//     "regionName: ".$sheetRegions->getCell('B'.$i)->getValue().
//     "<br>";
//     }

// echo "<hr>";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetPrefectures->getCell('A'.$i)->getValue() === '' || $sheetPrefectures->getCell('A'.$i)->getValue() === null ) break;

//     // echo "pId: ".$sheetPrefectures->getCell('A'.$i)->getValue()." / ".
//     echo "prefName: ".$sheetPrefectures->getCell('B'.$i)->getValue()." / ".
//     "rId: ".$sheetPrefectures->getCell('C'.$i)->getValue().
//     "<br>";
//     }

// echo "<hr>";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetBreweries->getCell('A'.$i)->getValue() === '' || $sheetBreweries->getCell('A'.$i)->getValue() === null ) break;

//     // echo "bId: ".$sheetBreweries->getCell('A'.$i)->getValue()." / ".
//     echo "breName: ".$sheetBreweries->getCell('B'.$i)->getValue()." / ".
//     "rId: ".$sheetBreweries->getCell('c'.$i)->getValue()." / ".
//     "pId: ".$sheetBreweries->getCell('d'.$i)->getValue().
//     "<br>";
//     }
//

// $regSql = "INSERT INTO `sake_regions` (`regionName`) ";
// $regSql.= "VALUES (?)";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetRegions->getCell('A'.$i)->getValue() === '' || $sheetRegions->getCell('A'.$i)->getValue() === null ) break;

//     $regParam = [
//         $sheetRegions->getCell('B'.$i)->getValue()
//     ];
    
//     $stmtReg = $pdo->prepare($regSql);
//     $stmtReg->execute($regParam);
// }

// $prefSql = "INSERT INTO `sake_prefectures` (`prefName`, `rId`) ";
// $prefSql.= "VALUES (?, ?)";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetPrefectures->getCell('A'.$i)->getValue() === '' || $sheetPrefectures->getCell('A'.$i)->getValue() === null ) break;

//     $prefParam = [
//         $sheetPrefectures->getCell('B'.$i)->getValue(),
//         $sheetPrefectures->getCell('C'.$i)->getValue()
//     ];
    
//     $stmtPref = $pdo->prepare($prefSql);
//     $stmtPref->execute($prefParam);
// }

// $brefSql = "INSERT INTO `sake_breweries` (`breName`, `rId`, `pId`) ";
// $brefSql.= "VALUES (?, ?, ?)";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetBreweries->getCell('A'.$i)->getValue() === '' || $sheetBreweries->getCell('A'.$i)->getValue() === null ) break;

//     $breParam = [
//         $sheetBreweries->getCell('B'.$i)->getValue(),
//         $sheetBreweries->getCell('C'.$i)->getValue(),
//         $sheetBreweries->getCell('D'.$i)->getValue()
//     ];
    
//     $stmtBre = $pdo->prepare($brefSql);
//     $stmtBre->execute($breParam);
// }

// $itemSql = "INSERT INTO `sake_items` (`breId`, `itemName`, `vId`,
//             `capacity`, `nihonshudo`, `alcohol`, `price`, `riceId`) ";
// $itemSql.= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// for($i = 2; $i <= $highestRow; $i++) {
//     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
//     if( $sheetItems->getCell('A'.$i)->getValue() === '' || $sheetItems->getCell('A'.$i)->getValue() === null ) break;

//     $itemParam = [
//         $sheetItems->getCell('D'.$i)->getValue(),
//         $sheetItems->getCell('E'.$i)->getValue(),
//         $sheetItems->getCell('F'.$i)->getValue(),
//         $sheetItems->getCell('G'.$i)->getValue(),
//         $sheetItems->getCell('H'.$i)->getValue(),
//         $sheetItems->getCell('I'.$i)->getValue(),
//         $sheetItems->getCell('J'.$i)->getValue(),
//         $sheetItems->getCell('K'.$i)->getValue()
//     ];
    
//     $stmtItem = $pdo->prepare($itemSql);
//     $stmtItem->execute($itemParam);
// }

// $riceSql = "INSERT INTO `sake_rice` (`riceName`) 
//             VALUES (?) ";

// for($i = 2; $i <= $highestRow; $i++) {
//     if( $sheetRice->getCell('A'.$i)->getValue() === '' || $sheetRice->getCell('A'.$i)->getValue() === null ) break;
//     $riceParam = [
//         $sheetRice->getCell('B'.$i)->getValue()
//     ];
        
//     $stmtRice = $pdo->prepare($riceSql);
//     $stmtRice->execute($riceParam);
// }

$varSql = "INSERT INTO `sake_varieties` (`varieties`, `vCatag`, `alchoholAdd`, `seimaibuai`) 
           VALUES (?, ?, ?, ? ) ";

for($i = 2; $i <= $highestRow; $i++) {
    if( $sheetVar->getCell('A'.$i)->getValue() === '' || $sheetVar->getCell('A'.$i)->getValue() === null ) break;

    $varParam = [
        $sheetVar->getCell('B'.$i)->getValue(),
        $sheetVar->getCell('C'.$i)->getValue(),
        $sheetVar->getCell('D'.$i)->getValue(),
        $sheetVar->getCell('E'.$i)->getValue()
    ];
        
    $stmtVar = $pdo->prepare($varSql);
    $stmtVar->execute($varParam);
}