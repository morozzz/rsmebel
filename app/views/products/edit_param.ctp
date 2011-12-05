<style type="text/css">
input.price-input,
input.cnt-input,
input.sort-order-input,
input.param-input{
    width: 80px;
    text-align: right;
}
</style>

<?php
    if(empty($product['ProductDet'])) {
        echo $html->div('product-edit-param-error', 'Данный товар не имеет детализации');
    }
    if(empty($product['ProductParam'])) {
        echo $html->div('product-edit-param-error', 'Данный товар не имеет параметров');
    }

    echo $form->create('Product', array(
        'action' => 'save_param_list',
        'id' => 'product-param-form'
    ));

    echo $html->div('table-caption', $product['Product']['name']);
    echo "<table class=\"data-table\">";

    echo "<thead>";
    echo "<tr>";
    echo "<td>1С-код</td>";
    echo "<td>Артикул</td>";
    echo "<td>М. изображение</td>";
    echo "<td>Б. изображение</td>";
    
    foreach($product['ProductParam'] as $product_param) {
        echo "<td>";
        echo $html->div('', $product_param['ProductParamType']['name']);
        echo $html->div('action',
                $html->link('ред.', array(
                    'controller' => 'product_params',
                    'action' => 'edit',
                    $product_param['id']
                )).
                $html->link('удал.', array(
                    'controller' => 'product_params',
                    'action' => 'delete',
                    $product_param['id']
                )));
        echo "</td>";
    }
    echo "<td>Стоимость</td>";
    echo "<td>Количество</td>";
    echo "<td>Сортировка</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    foreach($product['ProductDet'] as $product_det) {
        echo "<tr>";
        echo "<td>".$product_det['code_1c']."</td>";
        echo "<td>".$product_det['article']."</td>";
        echo "<td>";
        if(!empty($product_det['SmallImage']['url'])) {
            echo $html->image($product_det['SmallImage']['url'], array(
                'class' => 'table-image'
            ));
        }
        echo "</td>";
        echo "<td>";
        if(!empty($product_det['BigImage']['url'])) {
            echo $html->image($product_det['BigImage']['url'], array(
                'class' => 'table-image'
            ));
        }
        echo "</td>";
        foreach($product['ProductParam'] as $product_param) {
            echo "<td>";
            if($product_param['product_param_show_type_id'] == 1) {
                echo $form->text('', array(
                    'name' => 'data[product_dets]['.$product_det['id'].'][product_det_params]['.$product_det['ProductParam'][$product_param['id']]['id'].']',
                    'value' => $product_det['ProductParam'][$product_param['id']]['value'],
                    'class' => 'param-input'
                ));
            } else if($product_param['product_param_show_type_id'] == 2) {
                echo $form->select(
                        '',
                        $product_det_param_values_list,
                        $product_det['ProductParam'][$product_param['id']]['product_det_param_value_id'],
                        array(
                            'name' => 'data[product_dets]['.$product_det['id'].'][product_det_params]['.$product_det['ProductParam'][$product_param['id']]['id'].']'
                        ), false
                );
            }
//            echo $product_det['ProductParam'][$product_param['id']];
            echo "</td>";
        }
        echo "<td>".$form->text('', array(
            'name' => 'data[product_dets]['.$product_det['id'].'][price]',
            'value' => $product_det['price'],
            'class' => 'price-input textbox-float'
        ))."</td>";
        echo "<td>".$form->text('', array(
            'name' => 'data[product_dets]['.$product_det['id'].'][cnt]',
            'value' => $product_det['cnt'],
            'class' => 'cnt-input textbox-int'
        ))."</td>";
        echo "<td>".$form->text('', array(
            'name' => 'data[product_dets]['.$product_det['id'].'][sort_order]',
            'value' => $product_det['sort_order'],
            'class' => 'sort-order-input textbox-int'
        ))."</td>";
//        echo "<td>".$product_det['price']."</td>";
//        echo "<td>".$product_det['sort_order']."</td>";
        echo "<td>";
        echo $html->div('action', $html->link('ред', array(
            'controller' => 'product_dets',
            'action' => 'edit',
            $product_det['id']
        )));
        echo "</td>";
        echo "<td>";
        echo $html->div('action', $html->link('удал', array(
            'controller' => 'product_dets',
            'action' => 'delete',
            $product_det['id']
        )));
        echo "</td>";
        echo "<td>";
        echo $html->div('action', $html->link('перенести в товары', array(
            'controller' => 'product_dets',
            'action' => 'move_to_product',
            $product_det['id']
        )));
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";

    echo "</table>";

    echo $form->hidden('id', array(
        'value' => $product['Product']['id']
    ));
    echo $form->submit('Сохранить');
    echo $form->end();

    echo $html->div('action add-link', $html->link('Добавить столбец', array(
        'controller' => 'product_params',
        'action' => 'add',
        $product['Product']['id']
        ))
    );
    echo $html->div('action add-link', $html->link('Добавить строку', array(
        'controller' => 'product_dets',
        'action' => 'add',
        $product['Product']['id']
        ))
    );

    echo $html->div('', $html->link('Назад', array(
        'controller' => 'catalogs',
        'action' => 'adm_catalog',
        $product['Product']['catalog_id']
    )));

    echo $html->div('', $html->link('К списку столбцов', array(
        'controller' => 'product_params',
        'action' => 'show_list',
        $product['Product']['id']
    )));
    echo $html->div('', $html->link('Цвета', array(
        'controller' => 'product_det_param_values',
        'action' => 'index'
    )));
?>

<script type="text/javascript">
    enable_validation();
</script>