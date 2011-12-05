<?php
    echo $html->div('form-caption',
        "Перенос товара в параметры другого товара: ".$product['Product']['name']
        //$product_param['Product']['name'] . ' / ' . $product_param['ProductParamType']['name']
    );

    echo "<div align=\"center\" class=\"form\">";
    echo $form->create('Product', array(
        'action' => 'move_to_param',
        'id' => 'product-move-to-param-form'
    ));

    echo $form->input('product_id', array(
        'label' => "Товар-родитель",
        'type' => 'select'
    ));
    echo $form->hidden('moving_product_id', array(
        'value' => $product['Product']['id']
    ));

    echo $form->submit("Перенести");
    echo $form->end();
    echo "</div>";
?>