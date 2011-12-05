<?php
$row = array(
    'Каталог: ',
    $catalog['Catalog']['name'],
    '',
    '',
    ''
);
$csv->addRow($row);
$row = array(
    'Номер',
    'Название',
    '1С-код',
    'Производитель',
    'Сортировка'
);
$csv->addRow($row);

foreach($catalogs as $catalog) {
    $row = array(
        $catalog['Catalog']['id'],
        $catalog['Catalog']['name'],
        $catalog['Catalog']['code_1c'],
        $catalog['Producer']['name'],
        $catalog['Catalog']['sort_order']
    );
    $csv->addRow($row);
}
$catalog_id = $catalog['Catalog']['id'];
$catalog_name = $catalog['Catalog']['name'];
echo $csv->render("$catalog_id - $catalog_name.csv", 'cp-1251');
?>