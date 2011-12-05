<?php
    $session->flash();

    echo "<div class=\"form form-cke\">";
    echo $form->create('Catalog', array(
        'action' => 'add',
        'id' => 'catalog-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
        'legend' => 'Каталог - добавление ('.$parent['Catalog']['name'].')',
        'name' => array(
            'label' => 'Заголовок'
        ),
        'catalog_id' => array(
            'label' => 'Нахождение',
            'value' => (empty($parent['Catalog']['id']))?0:$parent['Catalog']['id'],
            'type' => 'select'
        ),
//        'code_1c' => array(
//            'label' => '1С-код'
//        ),
        'sort_order' => array(
            'label' => 'Порядок сортировки',
            'class' => 'textbox-int'
        ),
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
        'short_about' => array(
            'label' => 'Короткое описание',
            'id' => 'short_about'
        ),
        'long_about' => array(
            'label' => 'Полное описание',
            'id' => 'long_about'
        )
    ));
    echo $form->hidden('parent_id', array('value' => $parent['Catalog']['id']));
    echo $form->hidden('', array(
        'value' => $referer,
        'name' => 'data[referer]'
    ));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        var oFCKeditor = new FCKeditor('short_about');
        oFCKeditor.BasePath = "<?php echo $this->webroot; ?>js/fckeditor/" ;
        oFCKeditor.Height = 300;
        oFCKeditor.ReplaceTextarea();

        var oFCKeditor = new FCKeditor('long_about');
        oFCKeditor.BasePath = "<?php echo $this->webroot; ?>js/fckeditor/" ;
        oFCKeditor.Height = 300;
        oFCKeditor.ReplaceTextarea();
    }

    enable_validation();
</script>