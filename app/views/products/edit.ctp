<?php
    $session->flash();

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Product', array(
        'action' => 'edit',
        'id' => 'product-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
        'legend' => 'Товар - редактирование',
        'catalog_id' => array(
            'label' => 'Каталог',
            'value' => $product['Product']['catalog_id'],
            'type' => 'select'
        ),
        'name' => array(
            'label' => 'Название',
            'value' => $product['Product']['name']
        ),
//        'code_1c' => array(
//            'label' => '1С-код',
//            'value' => $product['Product']['code_1c']
//        ),
        'small_image_file' => array(
            'label' => 'Маленькое изображение',
            'type' => 'file',
            'size' => 53
        ),
        'big_image_file' => array(
            'label' => 'Большое изображение',
            'type' => 'file',
            'size' => 53
        ),
        'article' => array(
            'label' => 'Артикул',
            'value' => $product['Product']['article']
        ),
        'price' => array(
            'label' => 'Стоимость',
            'value' => $product['Product']['price'],
            'class' => 'textbox-float'
        ),
        'cnt' => array(
            'label' => 'Количество',
            'value' => $product['Product']['cnt'],
            'class' => 'textbox-int'
        ),
        'sort_order' => array(
            'label' => 'Порядок сортировки',
            'value' => $product['Product']['sort_order'],
            'class' => 'textbox-int'
        ),
        'short_about' => array(
            'label' => 'Краткое описание',
            'value' => $product['Product']['short_about'],
            'id' => 'short_about'
        ),
        'long_about' => array(
            'label' => 'Полное описание',
            'value' => $product['Product']['long_about'],
            'id' => 'long_about'
        )
    ));
    echo $form->hidden('id', array('value' => $product['Product']['id']));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        var oFCKeditor = new FCKeditor('short_about');
        oFCKeditor.BasePath = "<?php echo $this->webroot; ?>js/fckeditor/" ;
        oFCKeditor.Height = 500;
        oFCKeditor.ReplaceTextarea();

        var oFCKeditor = new FCKeditor('long_about');
        oFCKeditor.BasePath = "<?php echo $this->webroot; ?>js/fckeditor/" ;
        oFCKeditor.Height = 500;
        oFCKeditor.ReplaceTextarea();
    }

    enable_validation();
</script>