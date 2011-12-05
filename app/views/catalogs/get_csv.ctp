<?php
foreach($list as $row) {
    $csv->addRow(array(
        $row['type'],
        $row['parent'],
        $row['code_1c'],
        $row['name'],
        $row['price'],
        $row['cnt']
    ));
}
echo $csv->render("$filename.csv", 'cp-1251');
?>