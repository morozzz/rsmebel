<?php
    echo $html->div('form-caption',
        $product_param['Product']['name'] . ' / ' . $product_param['ProductParamType']['name']
    );

    echo "<div align=\"center\" class=\"form\"";
    echo $form->create("ProductParam", array(
        'action' => 'delete',
        'id' => 'product-param-delete-form'
    ));

    echo $form->input('product_param_type_id', array(
        'label' => 'Тип',
        'value' => $product_param['ProductParamType']['name'],
        'readonly' => true
    ));
    echo $form->input('product_param_show_type_id', array(
        'label' => 'Тип отображения',
        'type' => 'select',
        'value' => $product_param['ProductParam']['product_param_show_type_id'],
        'readonly' => true
    ));
    echo $form->input('sort_order', array(
        'label' => 'Сортировка',
        'value' => $product_param['ProductParam']['sort_order'],
        'readonly' => true
    ));
    echo $form->hidden('id', array(
        'value' => $product_param['ProductParam']['id']
    ));
    echo $form->hidden('Product.id', array(
        'value' => $product_param['Product']['id']
    ));

    echo $form->submit('Удалить');
    echo $form->end();
    echo "</div>";
?>