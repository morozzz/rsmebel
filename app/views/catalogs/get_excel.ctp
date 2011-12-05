<?php

/* Define fieldnames: */
$fieldnames= array('id', 'name');

/* Set default font styles: */
$excel->font = 'Tahoma';
$excel->size = 8;
$excel->initFormats(); // initialize default formats

/* Add style for heading: */
//$heading_format = $excel->AddFormat(array('bold' => 1, 'align' => 'center'));

/* Change TIME_FORMAT: */
//$excel->formats[TIME_FORMAT]->setNumFormat('hh:mm'); // direct library call

/* Create Excel sheets: */
$sheet1 =& $excel->AddWorksheet('Sheet Name');

/* Define layout of worksheet for applications: */
//$sheet1->setColumn(0, 0, 5);
//$sheet1->setColumn(7, 10, 8);
//$sheet1->setColumn(0, 28, 18);
//$sheet1->freezePanes(array(1, 1)); // Freeze sheet at 1st row and 1st column

/* Write headings: */
//$excel->write($sheet1, 0, 0, $fieldnames, $heading_format);

/* Write data for applications: */
//foreach($data['sheet1'] as $key => $value) {
//  $i = 0;
//  foreach($data['sheet1'][$key]['Model'] as $fieldname => $fieldvalue) {
//    if($fieldname =='birthdate') {
//      $excel->write($sheet1, $key+1, $i, $excel->MysqlDatetimeToExcel($fieldvalue), DATE_FORMAT);
//    }
//    elseif($fieldname == 'created') {
//      $excel->write($sheet1, $key+1, $i, $excel->MysqlDatetimeToExcel($fieldvalue), DATETIME_FORMAT);
//    }
//    elseif($fieldname == 'finances' || $fieldname == 'expenses'){
//      $excel->write($sheet1, $key+1, $i, $fieldvalue, MONEY_FORMAT);
//    }
//    else {
//      $excel->write($sheet1, $key+1, $i, $fieldvalue);
//    }
//    $i++;
//  }
//}

/* Output temporary file to the browser: */
$excel->OutputFile();

?>