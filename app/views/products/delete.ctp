<?php
    $session->flash();

    echo "<div align=\"center\" class=\"form\">";
    echo $form->create('Product', array(
        'action' => 'delete',
        'id' => 'product-delete-form'
    ));

    echo $form->inputs(array(
        'legend' => 'Товар - удаление',
        'catalog_id' => array(
            'label' => 'Каталог',
            'value' => $product['Product']['catalog_id'],
            'type' => 'select',
            'readonly' => true,
            'disabled' => true
        ),
        'name' => array(
            'label' => 'Заголовок',
            'value' => $product['Product']['name'],
            'readonly' => true
        ),
//        'code_1c' => array(
//            'label' => '1С-код',
//            'value' => $product['Product']['code_1c'],
//            'readonly' => true
//        ),
        'article' => array(
            'label' => 'Артикул',
            'value' => $product['Product']['article'],
            'readonly' => true
        ),
        'price' => array(
            'label' => 'Стоимость',
            'value' => $product['Product']['price'],
            'readonly' => true
        ),
        'cnt' => array(
            'label' => 'Количество',
            'value' => $product['Product']['cnt'],
            'readonly' => true
        ),
        'sort_order' => array(
            'label' => 'Порядок сортировки',
            'value' => $product['Product']['sort_order'],
            'readonly' => true
        ),
        'short_about' => array(
            'label' => 'Краткое описание',
            'value' => $product['Product']['short_about'],
            'readonly' => true
        ),
        'long_about' => array(
            'label' => 'Полное описание',
            'value' => $product['Product']['long_about'],
            'readonly' => true
        )
    ));
    echo $form->hidden('id', array('value' => $product['Product']['id']));
    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>