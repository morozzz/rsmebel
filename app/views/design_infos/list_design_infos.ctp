<?php
    echo $html->div('table-caption', 'Список страниц во вкладке "ДИЗАЙН"');

    echo "<fieldset>";
    echo $html->div('action',
            $html->link('Добавить страницу', array(
                'controller' => 'design_infos',
                'action' => 'add'
            ))
    );
    echo "<table class=\"data-table tree-table\" id=\"design_infos-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('design_infos_header', 'Заголовок'),
        $html->div('design_infos_header', 'Сортировка'),
        '',''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($design_infos as $design_info) {

        echo $html->tableCells(array(
            $design_info['DesignInfo']['news_header'],

            $design_info['DesignInfo']['sort_order'],

            $html->div('action',
                    $html->link('ред', array(
                        'controller' => 'design_infos',
                        'action' => 'edit',
                        $design_info['DesignInfo']['id']
                    ))
            ),
            $html->div('action',
                    $html->link('удал', array(
                        'controller' => 'design_infos',
                        'action' => 'delete',
                        $design_info['DesignInfo']['id']
                    ))
            )
            ));
    }
    echo "</tbody>";
    echo "</table>";
    echo "</fieldset>";

?>
