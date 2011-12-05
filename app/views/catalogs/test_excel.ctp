<?php

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C5', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'ПЫЩПЫЩ');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');

$iDrowing = new PHPExcel_Worksheet_Drawing();
//берем рисунок
$iDrowing->setPath("img/small_star.png");

//устанавливаем ячейку
$iDrowing->setCoordinates("E8");

//устанавливаем смещение X и Y
//$iDrowing->setOffsetX(50);
//$iDrowing->setOffsetY(50);

//помещаем на лист
$iDrowing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->mergeCells('A1:B2');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ололошеньки');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
//exit;
?>