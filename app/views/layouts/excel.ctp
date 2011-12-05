<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
header('Cache-Control: max-age=0');

$worksheet =& $objPHPExcel->getActiveSheet();
$iDrowing = new PHPExcel_Worksheet_Drawing();
$iDrowing->setPath("logo.jpg");
$iDrowing->setOffsetY(10);
$iDrowing->setCoordinates("A1");
$iDrowing->setWorksheet($worksheet);
$worksheet->mergeCells('A1:B3');
$worksheet->getCell('A1')->getHyperlink()->setUrl('http://mto24.ru');
$worksheet->getRowDimension('1')->setRowHeight(80);
$worksheet->getRowDimension('2')->setRowHeight(15);
$worksheet->getRowDimension('3')->setRowHeight(15);
$worksheet->getColumnDimension('A')->setWidth(25);
$worksheet->getColumnDimension('B')->setWidth(20);

$worksheet->mergeCells('C1:E1');
$worksheet->mergeCells('C2:F2');
$worksheet->mergeCells('C3:F3');
$worksheet->getColumnDimension('C')->setWidth(20);
$worksheet->getColumnDimension('D')->setWidth(25);
$worksheet->getColumnDimension('E')->setWidth(20);
$worksheet->getColumnDimension('F')->setWidth(20);
$worksheet->getStyle('C1')->getAlignment()->setWrapText(true);
$worksheet->getStyle('C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


//$str = $strs[9];
//$str = str_replace('<br>', "\n", $str);
//$str = str_replace('<br/>', "\n", $str);
//$str = str_replace('<br />', "\n", $str);
//$str = str_replace('</div>', "\n", $str);
//$str = str_replace('</p>', "\n", $str);
//$str = str_replace('&nbsp;', "", $str);
//$str = str_replace('&ndash;', "", $str);
//$str = str_replace("\t", "", $str);
//$str = strip_tags($str);
//$worksheet->setCellValue('C1', str_replace('<br>', "\n", $str));
$worksheet->setCellValue('C1', "Анжелика - Торговое оборудование\n".
        "г. Красноярск, ул. Вавилова 3, индекс 660093\n".
        "тел.(83912) 265-365 (офис);\n".
        "тел.(83912) 941-495 (сотовый);\n".
        "тел.(83912) 265-365 (факс);");
$worksheet->setCellValue('F1', "Дата создания: \n".date("d.m.Y"));
$worksheet->getStyle('F1')->applyFromArray(array(
    'font' => array(
        'bold' => true
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
    )
));
$worksheet->getStyle('F1')->getAlignment()->setWrapText(true);
$worksheet->getStyle("C2:C3")->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
$worksheet->setCellValue('C2', "Сайт: mto24.ru");
$worksheet->getCell('C2')->getHyperlink()->setUrl('http://mto24.ru');
$worksheet->setCellValue('C3', "Электронная почта: mto24@mail.ru");
$worksheet->getCell('C3')->getHyperlink()->setUrl('mailto:mto24@mail.ru');

$worksheet->getPageSetup()->setFitToWidth(1);
$worksheet->getPageSetup()->setFitToHeight(1000);
$worksheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$worksheet->setShowGridlines(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('xls/'.$file_name.'.xls');
$objWriter->save('php://output');
//echo $content_for_layout;
?>