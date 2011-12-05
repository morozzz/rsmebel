<?php

    //debug($shop_rules);
    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('ShopRule', array(
        'action' => 'edit',
        'id' => 'shop-rule-edit-form'
    ));

    echo $form->inputs(array(
          'legend' => $rule_header,

          'body_text' => array(
            'label'       => '',
            'value' => $shop_rules['ShopRule']['body_text'],
            'id' => 'body_text',
            'type' => 'textarea'
          )
    ));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.replace('body_text');
    }

    enable_validation();
</script>