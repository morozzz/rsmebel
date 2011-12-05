<?php
header("Content-type:application/pdf;");
App::import('Vendor','xtcpdf');
$tcpdf = new XTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$tcpdf->SetFont('arial', '', 10);
$tcpdf->AddPage();
//$css = file_get_contents("../webroot/css/report/report.css");
//$css = "<style type=\"text/css\">$css</style>";
//$tcpdf->writeHTML($css, true, false, true, false, '');
$tcpdf->writeHTML($content_for_layout, true, false, true, false, '');

//echo $tcpdf->Output('pdf/'.$filename, 'F');
echo $tcpdf->Output($filename, 'I');
?>