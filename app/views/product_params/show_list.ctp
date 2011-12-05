<?php
    if(empty($product_params)) {
        echo $html->div('product-param-show-list-error', 'Таблица параметров данного товара пуста');
    }

    echo $form->create('ProductParam', array(
        'action' => 'save_list',
        'id' => 'product-param-form'
    ));

    echo $html->div('table-caption', $product['Product']['name'] . ' - параметры');
    echo "<table class=\"data-table\">";

    echo "<thead>";
    echo "<tr>";
    echo "<td>Название</td>";
    echo "<td>Тип отображения</td>";
    echo "<td>Сортировка</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    foreach($product_params as $product_param) {
        echo "<tr>";
        echo "<td>".$product_param['ProductParamType']['name']."</td>";
        echo "<td>".$form->select('', $product_param_show_types,
            $product_param['ProductParam']['product_param_show_type_id'], array(
                'name' => 'data[product_params]['.$product_param['ProductParam']['id'].'][product_param_show_type_id]',
                'class' => 'product-param-show-type-input'
            ), false)."</td>";
        echo "<td>".$form->text('', array(
            'name' => 'data[product_params]['.$product_param['ProductParam']['id'].'][sort_order]',
            'value' => $product_param['ProductParam']['sort_order'],
            'class' => 'sort-order-input textbox-int'
        ))."</td>";
        //echo "<td>".$product_param['ProductParam']['sort_order']."</td>";
        echo "<td>".$html->div('action', $html->link('ред', array(
            'controller' => 'product_params',
            'action' => 'edit',
            $product_param['ProductParam']['id']
        )))."</td>";
        echo "<td>".$html->div('action', $html->link('удал', array(
            'controller' => 'product_params',
            'action' => 'delete',
            $product_param['ProductParam']['id']
        )))."</td>";
        echo "</tr>";
    }
    echo "</tbody>";

    echo "</table>";

    echo $form->hidden('', array(
        'name' => 'data[product][id]',
        'value' => $product['Product']['id']
    ));
    echo $form->submit('Сохранить');
    echo $form->end();

    echo $html->div('action add-link', $html->link('Добавить', array(
        'controller' => 'product_params',
        'action' => 'add',
        $product['Product']['id']
        ))
    );

    echo $html->div('', $html->link('К параметрам данной модели', array(
        'controller' => 'products',
        'action' => 'edit_param',
        $product['Product']['id']
    )));
?>

<script type="text/javascript">
    enable_validation();
</script>