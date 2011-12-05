<style type="text/css">
#company_infos-list-table td {
  font-weight: bold;
}
#company_infos-list-table h1 {
  font-size: 12px;
}
.company_infos_header {
    color: red;
}

</style>

<?php
    echo $html->div('table-caption', 'Список страниц во вкладке "О Компании"');

    echo "<fieldset>";
    echo $html->div('action',
            $html->link('Добавить страницу', array(
                'controller' => 'company_infos',
                'action' => 'add'
            ))
    );
    echo "<table class=\"data-table tree-table\" id=\"company_infos-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('company_infos_header', 'Заголовок'),
        $html->div('company_infos_header', 'Сортировка'),
        '',''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($company_infos as $company_info) {

        echo $html->tableCells(array(
            $company_info['CompanyInfo']['news_header'],

            $company_info['CompanyInfo']['sort_order'],

            $html->div('action',
                    $html->link('ред', array(
                        'controller' => 'company_infos',
                        'action' => 'edit',
                        $company_info['CompanyInfo']['id']
                    ))
            ),
            $html->div('action',
                    $html->link('удал', array(
                        'controller' => 'company_infos',
                        'action' => 'delete',
                        $company_info['CompanyInfo']['id']
                    ))
            )
            ));
    }
    echo "</tbody>";
    echo "</table>";
    echo "</fieldset>";

?>
