<?php
$objPHPExcel->setActiveSheetIndex(0);
$worksheet =& $objPHPExcel->getActiveSheet();
//$worksheet->setTitle(substr($catalog['Catalog']['name'], 0, 20));

//заголовок
$i_row = 4;
$worksheet->mergeCells("A$i_row:F$i_row");
$worksheet->getRowDimension($i_row)->setRowHeight(20);
$worksheet->setCellValue("A$i_row", $catalog['Catalog']['name']);
$worksheet->getStyle("A$i_row")->applyFromArray(array(
    'font' => array(
        'name' => 'Arial Cyr',
        'size' => '16',
        'bold' => true
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
));

$i_row++;
//описание каталога
$long_about = $catalog['Catalog']['long_about'];
$long_about = str_replace('<br>', "\n", $long_about);
$long_about = str_replace('<br/>', "\n", $long_about);
$long_about = str_replace('<br />', "\n", $long_about);
$long_about = str_replace('</div>', "\n", $long_about);
$long_about = str_replace('</p>', "\n", $long_about);
$long_about = str_replace('&nbsp;', "", $long_about);
$long_about = str_replace('&ndash;', "", $long_about);
$long_about = str_replace("\t", "", $long_about);
$long_about = strip_tags($long_about);
if($long_about != "") {
    $worksheet->mergeCells("A$i_row:F$i_row");
    $worksheet->getRowDimension($i_row)->setRowHeight(200);
    $worksheet->getStyle("A$i_row")->getAlignment()->setWrapText(true);
    $worksheet->setCellValue("A$i_row", $long_about);
    $worksheet->getStyle("A$i_row")->applyFromArray(array(
        'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
        )
    ));
    $i_row++;
}

//заголовки таблицы
//$worksheet->getStyle("A$i_row:F$i_row")->applyFromArray(array(
//    'font' => array(
//        'name' => 'Arial Cyr',
//        'size' => '12',
//        'bold' => true
//    ),
//    'alignment' => array(
//        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
//    )
//));
//$worksheet->setCellValue("A$i_row", 'Изображение');
//$worksheet->setCellValue("B$i_row", 'Название');
//$worksheet->setCellValue("C$i_row", 'Производитель');
//$worksheet->setCellValue("D$i_row", 'Есть на складе');
//$worksheet->setCellValue("E$i_row", 'Описание');
//$worksheet->setCellValue("F$i_row", 'Цена');
//$worksheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd($i_row, $i_row);
//$i_row++;

$i_col = 0;
$col_arrays = array(
    0 => array(
        'A',
        'B',
        'C'
    ),
    1 => array(
        'D',
        'E',
        'F'
    )
);
$i_products_start_row = $i_row;
foreach($products as $product) {
    $dop = '';
    if(!empty($product['ProductData'])) {
        foreach($product['ProductData'] as $product_data) {
            $product_param_name = $product_data['ProductParamType']['name'];
            $value = $product_data['ProductDetParamValue']['name'];
            $dop .= "$product_param_name: $value;\n";
        }
    }

    if(empty($product['ProductDet'])) {
        $col_array = $col_arrays[$i_col];
        
        $worksheet->mergeCells("{$col_array[0]}$i_row:{$col_array[2]}$i_row");
        $worksheet->setCellValue("{$col_array[0]}$i_row", $product['Product']['name']);
        $worksheet->getStyle("{$col_array[0]}$i_row")->applyFromArray(array(
            'font' => array(
                'bold' => true,
                'size' => 14
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            )
        ));

        $i_row_info = $i_row+1;
        $worksheet->getRowDimension($i_row_info)->setRowHeight(120);
        $worksheet->mergeCells("{$col_array[1]}$i_row_info:{$col_array[2]}$i_row_info");

        $img_path = 'img/nopic.gif';
        if(!empty($product['SmallImage']) && !empty($product['SmallImage']['url'])) {
            if(file_exists('img/'.$product['SmallImage']['url'])) {
                $img_path = 'img/'.$product['SmallImage']['url'];
            }
        }
        $iDrowing = new PHPExcel_Worksheet_Drawing();
        $iDrowing->setPath($img_path);
        $iDrowing->setOffsetY(2);
        $iDrowing->setCoordinates("{$col_array[0]}$i_row_info");
        $iDrowing->setHeight(150);
        $iDrowing->setWorksheet($worksheet);

        $producer_name = 'не указан';
        if(!empty($product['Producer']['name'])) {
            $producer_name = $product['Producer']['name'];
        }

//        $worksheet->setCellValue('B'.$i_row, $product['Product']['name']);
//        $worksheet->setCellValue('C'.$i_row, $producer_name);
//        $worksheet->setCellValue('D'.$i_row, (($product['Product']['cnt']>0)?'есть':'нет'));
//        $worksheet->setCellValue('E'.$i_row, $dop);
//        $worksheet->setCellValue('F'.$i_row, $product['Product']['price'].'руб.');

        $worksheet->setCellValue("{$col_array[1]}$i_row_info", //$product['Product']['name']."\n".
                "Производитель: $producer_name\n".
                "На складе: ".(($product['Product']['cnt']>0)?'есть':'нет')."\n".
                "$dop\n");
        $worksheet->getStyle("{$col_array[1]}$i_row_info:{$col_array[2]}$i_row_info")
        ->applyFromArray(array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrap' => true
            )
        ));

        //цена
        $i_row_price = $i_row+2;
        $worksheet->mergeCells("{$col_array[0]}$i_row_price:{$col_array[2]}$i_row_price");
        $worksheet->setCellValue("{$col_array[0]}$i_row_price", "Цена: ".
                $product['Product']['price']."руб.");
        $worksheet->getStyle("{$col_array[0]}$i_row_price")->applyFromArray(array(
            'font' => array(
                'bold' => true,
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
            )
        ));

//        $i_row++;
        $i_col++;
        if($i_col == 2) {
            $worksheet->getStyle("A$i_row:F$i_row_price")->applyFromArray(array(
                'borders' => array(
                    'top' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                    'bottom' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                    'left' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            ));
            
            $i_col = 0;
            $i_row+= 3;
        }
    } else {
        foreach($product['ProductDet'] as $product_det) {
            $dop2 = $dop;
            foreach($product_det['ProductDetParam'] as $product_det_param) {
                $product_param_name = $product_det_param['ProductParam']['ProductParamType']['name'];
                $value = $product_det_param['ProductDetParamValue']['name'];

                $dop2 .= "$product_param_name: $value;\n";
            }

            $col_array = $col_arrays[$i_col];

            $worksheet->mergeCells("{$col_array[0]}$i_row:{$col_array[2]}$i_row");
            $worksheet->setCellValue("{$col_array[0]}$i_row", $product['Product']['name']);
            $worksheet->getStyle("{$col_array[0]}$i_row")->applyFromArray(array(
                'font' => array(
                    'bold' => true,
                    'size' => 14
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            ));

            $i_row_info = $i_row+1;
            $worksheet->getRowDimension($i_row_info)->setRowHeight(120);
            $worksheet->mergeCells("{$col_array[1]}$i_row_info:{$col_array[2]}$i_row_info");

            $img_path = null;
            if(!empty($product['SmallImage']))
                $img_path = $product['SmallImage']['url'];
            if(!empty($product_det["SmallImage"]))
                $img_path = $product_det['SmallImage']['url'];
            if($img_path == null)
                $img_path = 'nopic.gif';
            $img_path = 'img/'.$img_path;
            $iDrowing = new PHPExcel_Worksheet_Drawing();
            $iDrowing->setPath($img_path);
            $iDrowing->setOffsetY(2);
            $iDrowing->setCoordinates("{$col_array[0]}$i_row_info");
            $iDrowing->setHeight(150);
            $iDrowing->setWorksheet($worksheet);

            $producer_name = 'не указан';
            if(!empty($product_det['Producer']['name'])) {
                $producer_name = $product['Producer']['name'];
            }

//            $worksheet->setCellValue('B'.$i_row, $product['Product']['name']);
//            $worksheet->setCellValue('C'.$i_row, $producer_name);
//            $worksheet->setCellValue('D'.$i_row, (($product_det['cnt']>0)?'есть':'нет'));
//            $worksheet->setCellValue('E'.$i_row, $dop2);
//            $worksheet->setCellValue('F'.$i_row, $product_det['price'].'руб.');

            $worksheet->setCellValue("{$col_array[1]}$i_row_info", //$product['Product']['name']."\n".
                    "Производитель: $producer_name\n".
                    "На складе: ".(($product_det['cnt']>0)?'есть':'нет')."\n".
                    "$dop2\n");
            $worksheet->getStyle("{$col_array[1]}$i_row_info:{$col_array[2]}$i_row_info")
            ->applyFromArray(array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                    'wrap' => true
                )
            ));

            //цена
            $i_row_price = $i_row+2;
            $worksheet->mergeCells("{$col_array[0]}$i_row_price:{$col_array[2]}$i_row_price");
            $worksheet->setCellValue("{$col_array[0]}$i_row_price", "Цена: ".
                    $product_det['price']."руб.");
            $worksheet->getStyle("{$col_array[0]}$i_row_price")->applyFromArray(array(
                'font' => array(
                    'bold' => true,
                    'size' => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
                )
            ));

//            $i_row++;
            $i_col++;
            if($i_col == 2) {
                $worksheet->getStyle("A$i_row:F$i_row_price")->applyFromArray(array(
                    'borders' => array(
                        'top' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'bottom' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'left' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'right' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                ));

                $i_col = 0;
                $i_row+= 3;
            }
        }
    }

//    $row_col = $i_row-1;
//    $worksheet->getStyle("A$i_products_start_row:F$row_col")->applyFromArray(array(
//        'font' => array(
//            'name' => 'Arial Cyr',
//            'size' => '11',
//            'bold' => false
//        ),
//        'alignment' => array(
//            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
//            'wrap' => true
//        )
//    ));
//    for($i=4; $i<=$row_col; $i++) {
//        $worksheet->getStyle("A$i:F$i")->applyFromArray(array(
//            'borders' => array(
//                'top' => array(
//                    'style' => PHPExcel_Style_Border::BORDER_THIN
//                ),
//                'bottom' => array(
//                    'style' => PHPExcel_Style_Border::BORDER_THIN
//                ),
//                'left' => array(
//                    'style' => PHPExcel_Style_Border::BORDER_THIN
//                ),
//                'right' => array(
//                    'style' => PHPExcel_Style_Border::BORDER_THIN
//                )
//            )
//        ));
//    }
//
//    $worksheet->getStyle("B$i_products_start_row:B$row_col")->applyFromArray(array(
//        'font' => array(
//            'size' => '12',
//            'bold' => true
//        ),
//        'alignment' => array(
//            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
//        )
//    ));
//
//    $worksheet->getStyle("F$i_products_start_row:F$row_col")->applyFromArray(array(
//        'font' => array(
//            'bold' => true
//        ),
//        'alignment' => array(
//            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
//        )
//    ));
//
//    $worksheet->getPageSetup()->setPrintArea('A1:F'.$row_col);
}

if($i_col==1) {
    $i_row_price = $i_row+2;
    $worksheet->getStyle("A$i_row:F$i_row_price")->applyFromArray(array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
            'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
}
?>