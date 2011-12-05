<?php
    $session->flash();

    echo "<div class=\"form form-cke\">";
    echo $form->create('Product', array(
        'action' => 'add',
        'id' => 'product-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
        'legend' => 'Товар - добавление (категория - '.$parent['Catalog']['name'].')',
        'catalog_id' => array(
            'label' => 'Каталог',
            'type' => 'select',
            'value' => $parent['Catalog']['id']
        ),
        'name' => array(
            'label' => 'Название'
        ),
//        'code_1c' => array(
//            'label' => '1С-код'
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
            'label' => 'Артикул'
        ),
        'price' => array(
            'label' => 'Стоимость',
            'class' => 'textbox-float'
        ),
        'cnt' => array(
            'label' => 'Количество',
            'class' => 'textbox-int'
        ),
        'sort_order' => array(
            'label' => 'Порядок сортировки',
            'class' => 'textbox-int'
        ),
        'short_about' => array(
            'label' => 'Краткое описание',
            'id' => 'short_about'
        ),
        'long_about' => array(
            'label' => 'Полное описание',
            'id' => 'long_about'
        )
    ));
    //echo $form->hidden('catalog_id', array('value' => $parent['Catalog']['id']));
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