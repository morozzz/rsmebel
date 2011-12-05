<?php

    echo $html->div('form-caption',
        $product_det['Product']['name'] . ' / ' . $product_det['ProductDet']['article']
    );

    echo "<div align=\"center\" class=\"form\">";
    echo $form->create('ProductDet', array(
        'action' => 'edit',
        'id' => 'product-det-edit-form',
        'type' => 'file'
    ));

    echo $form->input('ProductDet.article', array(
        'label' => 'Артикул',
        'value' => $product_det['ProductDet']['article']
    ));
    echo $form->input('small_image_file', array(
        'label' => 'Маленькое изображение',
        'type' => 'file',
        'size' => 53
    ));
    echo $form->input('big_image_file', array(
        'label' => 'Большое изображение',
        'type' => 'file',
        'size' => 53
    ));
    foreach($product_det['ProductParam'] as $product_param) {
        echo $form->input('ProductDetParam.'.$product_param['ProductDetParam']['id'], array(
            'label' => $product_param['ProductParamType']['name'],
            'value' => $product_param['ProductDetParam']['value']
        ));
    }
    echo $form->input('ProductDet.price', array(
        'label' => 'Стоимость',
        'value' => $product_det['ProductDet']['price']
    ));
    echo $form->input('ProductDet.cnt', array(
        'label' => 'Количество',
        'value' => $product_det['ProductDet']['cnt']
    ));
    echo $form->input('ProductDet.sort_order', array(
        'label' => 'Сортировка',
        'value' => $product_det['ProductDet']['sort_order']
    ));
    echo $form->hidden('id', array('value' => $product_det['ProductDet']['id']));
    echo $form->hidden('product_id', array('value' => $product_det['ProductDet']['product_id']));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";
?>