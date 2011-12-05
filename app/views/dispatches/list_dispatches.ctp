<?php

    echo $html->div('table-caption', 'Список отправленных рассылок');

    echo $form->create('Dispatch', array(
        'action' => 'delete',
        'id' => 'dispatch-edit-form'
    ));

    echo "<fieldset>";
    echo $html->div('action',
            $html->link('Добавить рассылку', array(
                'controller' => 'dispatches',
                'action' => 'add'
            ))
    );
    echo "<table class=\"data-table tree-table\" id=\"dispatches-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('dispatches_header', ''),
        $html->div('dispatches_header', 'Адресаты'),
        $html->div('dispatches_header', 'Тема'),
        $html->div('dispatches_header', 'Содержание рассылки'),
        $html->div('dispatches_header', 'Дата отправки')
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($dispatches as $dispatch) {

        echo $html->tableCells(array(
            "<input type='checkbox' name='data[DispatchChk][".$dispatch['Dispatch']['id']."]' class='chb-special-select'>",
            $dispatch['Dispatch']['address'],
            $dispatch['Dispatch']['dispatch_header'],

            $dispatch['Dispatch']['dispatch_body'],

            $dispatch[0]['stamp']

            ));
    }
    echo "</tbody>";
    echo "</table>";
    echo "</fieldset>";

    echo $form->submit('Удалить');

?>
