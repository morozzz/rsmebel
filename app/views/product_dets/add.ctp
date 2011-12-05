<?php
    echo $html->div('form-caption',
        $product['Product']['name']
    );

    echo "<div align=\"center\" class=\"form\">";
    echo $form->create('ProductDet', array(
        'action' => 'add',
        'id' => 'product-det-add-form',
        'type' => 'file'
    ));

//    echo $form->input('ProductDet.code_1c', array(
//        'label' => '1С-код'
//    ));
    echo $form->input('ProductDet.article', array(
        'label' => 'Артикул'
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
    foreach($product_params as $product_param) {
        echo $form->input('ProductDetParam.'.$product_param['ProductParam']['id'], array(
            'label' => $product_param['ProductParamType']['name']
        ));
    }
    echo $form->input('ProductDet.price', array(
        'label' => 'Стоимость'
    ));
    echo $form->input('ProductDet.cnt', array(
        'label' => 'Количество'
    ));
    echo $form->input('ProductDet.sort_order', array(
        'label' => 'Сортировка'
    ));
    echo $form->hidden('product_id', array('value' => $product['Product']['id']));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";
?>