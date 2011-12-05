<?php
    echo $html->div('form-caption',
        $product_det['Product']['name'] . ' / ' . $product_det['ProductDet']['article']
    );

    echo "<div align=\"center\" class=\"form\">";
    echo $form->create('ProductDet', array(
        'action' => 'delete',
        'id' => 'product-delete-edit-form'
    ));

//    echo $form->input('ProductDet.code_1c', array(
//        'label' => '1С-код',
//        'value' => $product_det['ProductDet']['code_1c'],
//        'readonly' => true
//    ));
    echo $form->input('ProductDet.article', array(
        'label' => 'Артикул',
        'value' => $product_det['ProductDet']['article'],
        'readonly' => true
    ));
    foreach($product_det['ProductParam'] as $product_param) {
        echo $form->input('ProductDetParam.'.$product_param['ProductDetParam']['id'], array(
            'label' => $product_param['ProductParamType']['name'],
            'value' => $product_param['ProductDetParam']['value'],
            'readonly' => true
        ));
    }
    echo $form->input('ProductDet.price', array(
        'label' => 'Стоимость',
        'value' => $product_det['ProductDet']['price'],
        'readonly' => true
    ));
    echo $form->input('ProductDet.cnt', array(
        'label' => 'Количество',
        'value' => $product_det['ProductDet']['cnt'],
        'readonly' => true
    ));
    echo $form->input('ProductDet.sort_order', array(
        'label' => 'Сортировка',
        'value' => $product_det['ProductDet']['sort_order'],
        'readonly' => true
    ));
    echo $form->end();
    echo $form->create('ProductDet', array(
        'action' => 'delete',
        'id' => 'product-delete-edit-form'
    ));
    echo $form->hidden('id', array('value' => $product_det['ProductDet']['id']));
    echo $form->hidden('product_id', array('value' => $product_det['ProductDet']['product_id']));
    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";
?>