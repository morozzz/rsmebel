<?php
$objPHPExcel->setActiveSheetIndex(0);
$worksheet =& $objPHPExcel->getActiveSheet();

$i_row = 4;

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
foreach($catalogs as $catalog) {
    $worksheet->mergeCells("A$i_row:F$i_row");
    $worksheet->setCellValue("A$i_row", $catalog['Catalog']['name']);
    $worksheet->getStyle("A$i_row")->applyFromArray(array(
        'font' => array(
            'name' => 'Arial Cyr',
            'size' => '16',
            'bold' => true
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
        )
    ));
    $i_row++;

//    if(!empty($catalog['Product'])) {
//        //заголовки таблицы
//        $worksheet->getStyle("A$i_row:F$i_row")->applyFromArray(array(
//            'font' => array(
//                'name' => 'Arial Cyr',
//                'size' => '12',
//                'bold' => true
//            ),
//            'alignment' => array(
//                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
//            )
//        ));
//        $worksheet->setCellValue("A$i_row", 'Изображение');
//        $worksheet->setCellValue("B$i_row", 'Название');
//        $worksheet->setCellValue("C$i_row", 'Производитель');
//        $worksheet->setCellValue("D$i_row", 'Есть на складе');
//        $worksheet->setCellValue("E$i_row", 'Описание');
//        $worksheet->setCellValue("F$i_row", 'Цена');
//        $i_row++;
//    }
    $i_col = 0;
    foreach($catalog['Product'] as $product) {
        $product['Product'] = $product;
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
            $worksheet->setCellValue("{$col_array[0]}$i_row", $product['name']);
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
            $worksheet->getRowDimension($i_row_info)->setRowHeight(80);
            $worksheet->mergeCells("{$col_array[0]}$i_row_info:{$col_array[2]}$i_row_info");

//            $img_path = 'img/nopic.gif';
//            if(!empty($product['SmallImage']) && !empty($product['SmallImage']['url'])) {
//                if(file_exists('img/'.$product['SmallImage']['url'])) {
//                    $img_path = 'img/'.$product['SmallImage']['url'];
//                }
//            }
//            $iDrowing = new PHPExcel_Worksheet_Drawing();
//            $iDrowing->setPath($img_path);
//            $iDrowing->setOffsetY(2);
//            $iDrowing->setCoordinates("{$col_array[0]}$i_row_info");
//            $iDrowing->setHeight(150);
//            $iDrowing->setWorksheet($worksheet);

            $producer_name = 'не указан';
            if(!empty($product['Producer']['name'])) {
                $producer_name = $product['Producer']['name'];
            }

    //        $worksheet->setCellValue('B'.$i_row, $product['Product']['name']);
    //        $worksheet->setCellValue('C'.$i_row, $producer_name);
    //        $worksheet->setCellValue('D'.$i_row, (($product['Product']['cnt']>0)?'есть':'нет'));
    //        $worksheet->setCellValue('E'.$i_row, $dop);
    //        $worksheet->setCellValue('F'.$i_row, $product['Product']['price'].'руб.');

            $worksheet->setCellValue("{$col_array[0]}$i_row_info", //$product['Product']['name']."\n".
                    "Производитель: $producer_name\n".
                    "На складе: ".(($product['cnt']>0)?'есть':'нет')."\n".
                    "$dop\n");
            $worksheet->getStyle("{$col_array[0]}$i_row_info:{$col_array[2]}$i_row_info")
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
                    $product['price']."руб.");
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
                $worksheet->getRowDimension($i_row_info)->setRowHeight(80);
                $worksheet->mergeCells("{$col_array[0]}$i_row_info:{$col_array[2]}$i_row_info");

//                $img_path = null;
//                if(!empty($product['SmallImage']))
//                    $img_path = $product['SmallImage']['url'];
//                if(!empty($product_det["SmallImage"]))
//                    $img_path = $product_det['SmallImage']['url'];
//                if($img_path == null)
//                    $img_path = 'nopic.gif';
//                if(file_exists('img/'.$img_path)) {
//                    $img_path = 'img/'.$img_path;
//                } else {
//                    $img_path = 'img/nopic.gif';
//                }
//                $iDrowing = new PHPExcel_Worksheet_Drawing();
//                $iDrowing->setPath($img_path);
//                $iDrowing->setOffsetY(2);
//                $iDrowing->setCoordinates("{$col_array[0]}$i_row_info");
//                $iDrowing->setHeight(150);
//                $iDrowing->setWorksheet($worksheet);

                $producer_name = 'не указан';
                if(!empty($product_det['Producer']['name'])) {
                    $producer_name = $product['Producer']['name'];
                }

    //            $worksheet->setCellValue('B'.$i_row, $product['Product']['name']);
    //            $worksheet->setCellValue('C'.$i_row, $producer_name);
    //            $worksheet->setCellValue('D'.$i_row, (($product_det['cnt']>0)?'есть':'нет'));
    //            $worksheet->setCellValue('E'.$i_row, $dop2);
    //            $worksheet->setCellValue('F'.$i_row, $product_det['price'].'руб.');

                $worksheet->setCellValue("{$col_array[0]}$i_row_info", //$product['Product']['name']."\n".
                        "Производитель: $producer_name\n".
                        "На складе: ".(($product_det['cnt']>0)?'есть':'нет')."\n".
                        "$dop2\n");
                $worksheet->getStyle("{$col_array[0]}$i_row_info:{$col_array[2]}$i_row_info")
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
//        $i_row_product = $i_row;
//        $dop = '';
//        if(!empty($product['ProductData'])) {
//            foreach($product['ProductData'] as $product_data) {
//                $product_param_name = $product_data['ProductParamType']['name'];
//                $value = $product_data['ProductDetParamValue']['name'];
//                $dop .= "$product_param_name: $value;\n";
//            }
//        }
//
//        if(empty($product['ProductDet'])) {
//            $worksheet->getRowDimension($i_row)->setRowHeight(120);
//
//            $img_path = 'img/nopic.gif';
//            if(!empty($product['SmallImage']) && !empty($product['SmallImage']['url'])) {
//                if(file_exists('img/'.$product['SmallImage']['url'])) {
//                    $img_path = 'img/'.$product['SmallImage']['url'];
//                }
//            }
//            if(filesize($img_path)>(100*1024)) {
//                $img_path = 'img/nopic.gif';
//            }
//            $iDrowing = new PHPExcel_Worksheet_Drawing();
//            $iDrowing->setPath($img_path);
//            $iDrowing->setOffsetY(2);
//            $iDrowing->setCoordinates("A".$i_row);
//            $iDrowing->setHeight(150);
//            $iDrowing->setWorksheet($worksheet);
//
//            $producer_name = 'не указан';
//            if(!empty($product['Producer']['name'])) {
//                $producer_name = $product['Producer']['name'];
//            }
//
//            $worksheet->setCellValue('B'.$i_row, $product['name']);
//            $worksheet->setCellValue('C'.$i_row, $producer_name);
//            $worksheet->setCellValue('D'.$i_row, (($product['cnt']>0)?'есть':'нет'));
//            $worksheet->setCellValue('E'.$i_row, $dop);
//            $worksheet->setCellValue('F'.$i_row, $product['price'].'руб.');
//
//            $i_row++;
//        } else {
//            foreach($product['ProductDet'] as $product_det) {
//                $worksheet->getRowDimension($i_row)->setRowHeight(120);
//                $dop2 = $dop;
//                foreach($product_det['ProductDetParam'] as $product_det_param) {
//                    $product_param_name = $product_det_param['ProductParam']['ProductParamType']['name'];
//                    $value = $product_det_param['ProductDetParamValue']['name'];
//
//                    $dop2 .= "$product_param_name: $value;\n";
//                }
//
//                $img_path = null;
//                if(!empty($product['SmallImage']))
//                    $img_path = $product['SmallImage']['url'];
//                if(!empty($product_det["SmallImage"]))
//                    $img_path = $product_det['SmallImage']['url'];
//                if($img_path == null)
//                    $img_path = 'nopic.gif';
//                $img_path = 'img/'.$img_path;
//                if(!file_exists($img_path)) {
//                    $img_path = 'img/nopic.gif';
//                }
//                if(filesize($img_path)>(100*1024)) {
//                    $img_path = 'img/nopic.gif';
//                }
//                $iDrowing = new PHPExcel_Worksheet_Drawing();
//                $iDrowing->setPath($img_path);
//                $iDrowing->setOffsetY(2);
//                $iDrowing->setCoordinates("A".$i_row);
//                $iDrowing->setHeight(150);
//                $iDrowing->setWorksheet($worksheet);
//
//                $producer_name = 'не указан';
//                if(!empty($product_det['Producer']['name'])) {
//                    $producer_name = $product['Producer']['name'];
//                }
//
//                $worksheet->setCellValue('B'.$i_row, $product['name']);
//                $worksheet->setCellValue('C'.$i_row, $producer_name);
//                $worksheet->setCellValue('D'.$i_row, (($product_det['cnt']>0)?'есть':'нет'));
//                $worksheet->setCellValue('E'.$i_row, $dop2);
//                $worksheet->setCellValue('F'.$i_row, $product_det['price'].'руб.');
//
//                $i_row++;
//            }
//        }
//
//        $row_cnt = $i_row-1;
//        $worksheet->getStyle("A$i_row_product:F$row_cnt")->applyFromArray(array(
//            'font' => array(
//                'name' => 'Arial Cyr',
//                'size' => '11',
//                'bold' => false
//            ),
//            'alignment' => array(
//                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
//                'wrap' => true
//            )
//        ));
//        for($i=$i_row_product; $i<$i_row; $i++) {
//            $worksheet->getStyle("A$i:F$i")->applyFromArray(array(
//                'borders' => array(
//                    'top' => array(
//                        'style' => PHPExcel_Style_Border::BORDER_THIN
//                    ),
//                    'bottom' => array(
//                        'style' => PHPExcel_Style_Border::BORDER_THIN
//                    ),
//                    'left' => array(
//                        'style' => PHPExcel_Style_Border::BORDER_THIN
//                    ),
//                    'right' => array(
//                        'style' => PHPExcel_Style_Border::BORDER_THIN
//                    )
//                )
//            ));
//        }
//
//        $worksheet->getStyle("B$i_row_product:B$row_cnt")->applyFromArray(array(
//            'font' => array(
//                'size' => '12',
//                'bold' => true
//            ),
//            'alignment' => array(
//                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
//            )
//        ));
//
//        $worksheet->getStyle("F$i_row_product:F$row_cnt")->applyFromArray(array(
//            'font' => array(
//                'bold' => true
//            ),
//            'alignment' => array(
//                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
//            )
//        ));
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
        $i_row+=3;
    }
}