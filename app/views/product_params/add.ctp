<?php
    echo $html->div('form-caption',
        $product['Product']['name'] . ' / ' . 'Добавление параметра'
    );

    echo "<div align=\"center\" class=\"form\"";
    echo $form->create("ProductParam", array(
        'action' => 'add',
        'id' => 'product-param-add-form'
    ));

    echo $form->input('product_param_type_id', array(
        'label' => 'Тип',
        'type' => 'select',
        'onchange' => 'toggle_other_name();',
        'id' => 'input-product-param-type-id'
    ));
    echo $form->input('product_param_type_name', array(
        'label' => 'Другое название',
        'div' => array(
            'id' => 'div-product-param-type-name'
        )
    ));
    echo $form->input('product_param_show_type_id', array(
        'label' => 'Тип отображения',
        'type' => 'select'
    ));
    echo $form->input('sort_order', array(
        'label' => 'Сортировка'
    ));
    echo $form->hidden('product_id', array(
        'value' => $product['Product']['id']
    ));

    echo $form->submit('Сохранить');
    echo $form->end();
    echo "</div>";
?>

<script type="text/javascript">
    $(document).ready(function() {
        toggle_other_name();
    });

    function toggle_other_name() {
        if($('#input-product-param-type-id').val() == 0)
            $('#div-product-param-type-name').show('fast');
        else
            $('#div-product-param-type-name').hide('fast');
    }
</script>