<?php
$objPHPExcel->setActiveSheetIndex(0);
$worksheet =& $objPHPExcel->getActiveSheet();

$i_row = 4;
foreach($products as $product) {
    $image_url = $product['SmallImage']['url'];
    $image_url = substr($image_url,
            strpos($image_url, '/')+1,
            strpos($image_url, '.')-strpos($image_url, '/')-1);
    
    $worksheet->setCellValue("A$i_row", "Торговое оборудование");
    $worksheet->setCellValue("B$i_row", $product['Product']['name']);
    $worksheet->setCellValue("C$i_row", "");
    $worksheet->setCellValue("D$i_row", $product['Product']['short_note']);
    $worksheet->setCellValue("E$i_row", $product['Product']['price']);
    $worksheet->setCellValue("F$i_row", "РУБ");
    $worksheet->setCellValue("G$i_row", ($product['Product']['cnt']>0)?'+':'-');
    $worksheet->setCellValue("H$i_row", Router::url('/products/index/'.$product['Product']['id'], true));
    $worksheet->setCellValue("I$i_row", $image_url);
    
    $i_row++;
}
?>