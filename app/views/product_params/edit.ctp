<?php
    echo $html->div('form-caption',
        $product_param['Product']['name'] . ' / ' . $product_param['ProductParamType']['name']
    );

    echo "<div align=\"center\" class=\"form\"";
    echo $form->create("ProductParam", array(
        'action' => 'edit',
        'id' => 'product-param-edit-form'
    ));

    echo $form->input('product_param_type_id', array(
        'label' => 'Тип',
        'type' => 'select',
        'value' => $product_param['ProductParam']['product_param_type_id'],
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
        'type' => 'select',
        'value' => $product_param['ProductParam']['product_param_show_type_id']
    ));
    echo $form->input('sort_order', array(
        'label' => 'Сортировка',
        'value' => $product_param['ProductParam']['sort_order']
    ));
    echo $form->hidden('id', array(
        'value' => $product_param['ProductParam']['id']
    ));
    echo $form->hidden('Product.id', array(
        'value' => $product_param['Product']['id']
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