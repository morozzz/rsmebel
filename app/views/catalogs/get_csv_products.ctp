<?php
$row = array(
    'Каталог: ',
    $catalog['Catalog']['name'],
    '',
    '',
    '',
    '',
    '',
    '',
    ''
);
$csv->addRow($row);

$row = array(
    'Номер',
    'Название',
    '1С-код',
    'Артикул',
    'Производитель',
    'Дополнительно',
    'Количество',
    'Цена',
    'Сортировка'
);
$csv->addRow($row);

foreach($products as $product) {
    if(empty($product['ProductDet'])) {
        $row = array(
            $product['Product']['id'],
            $product['Product']['name'],
            $product['Product']['code_1c'],
            $product['Product']['article'],
            $product['Producer']['name'],
            '',
            $product['Product']['cnt'],
            $product['Product']['price'],
            $product['Product']['sort_order']
        );
        $csv->addRow($row);
    } else {
        foreach($product['ProductDet'] as $product_det) {
            $dop = '';
            foreach($product_det['ProductDetParam'] as $product_det_param) {
                $value = '';
                if(empty($product_det_param['ProductDetParam']['product_det_param_value_id'])) {
                    $value = $product_det_param['ProductDetParam']['value'];
                } else {
                    $value = $product_det_param['ProductDetParamValue']['name'];
                }

                $product_param_id = $product_det_param['ProductDetParam']['product_param_id'];
                $product_param = $product['ProductParam'][$product_param_id];
                $product_param_name = $product_param['ProductParamType']['name'];

                $dop .= "$product_param_name: $value; ";
            }

            $row = array(
                $product['Product']['id'].' ('.$product_det['ProductDet']['id'].')',
                $product['Product']['name'],
                $product_det['ProductDet']['code_1c'],
                $product_det['ProductDet']['article'],
                $product_det['Producer']['name'],
                $dop,
                $product_det['ProductDet']['cnt'],
                $product_det['ProductDet']['price'],
                $product['Product']['sort_order'].' ('.$product_det['ProductDet']['sort_order'].')'
            );
            $csv->addRow($row);
        }
    }
}
$catalog_id = $catalog['Catalog']['id'];
$catalog_name = $catalog['Catalog']['name'];
echo $csv->render("$catalog_id - $catalog_name.csv", 'cp-1251');
?>