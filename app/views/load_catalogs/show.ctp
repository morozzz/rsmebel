<?php

    echo $html->div('table-caption', 'Детализация загрузки каталога');

    echo "<table class=\"data-table tree-table\" id=\"load-catalog_det-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('catalog_det_header', 'Статус'),
        $html->div('catalog_det_header', 'Категория'),
        $html->div('catalog_det_header', 'Код родителя'),
        $html->div('catalog_det_header', 'Код товара/подкаталога'),
        $html->div('catalog_det_header', 'Наименование товара/подкаталога'),
        $html->div('catalog_det_header', 'Цена'),
        $html->div('catalog_det_header', 'Количество')
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($lcatalog_dets as $lcat) {

        echo $html->tableCells(array(
            $lcat['LoadCatalogDet']['status_name'],
            $lcat['LoadCatalogDet']['flag_name'],
            $lcat['LoadCatalogDet']['1c_kod_catalog'],
            $lcat['LoadCatalogDet']['1c_kod_product'],
            $lcat['LoadCatalogDet']['pname'],
            $lcat['LoadCatalogDet']['price'],
            $lcat['LoadCatalogDet']['cnt']
            ));
    }
    echo "</tbody>";
    echo "</table>";

?>
