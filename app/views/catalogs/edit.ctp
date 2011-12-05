<?php
    $session->flash();

    echo $html->div('image-action',
        $html->image($catalog['SmallImage']['url'])
    );
    echo $html->div('image-action',
        $html->image($catalog['BigImage']['url'])
    );

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Catalog', array(
        'action' => 'edit',
        'id' => 'catalog-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
        'legend' => 'Каталог - редактирование',
        'name' => array(
            'label' => 'Заголовок',
            'value' => $catalog['Catalog']['name']
        ),
        'catalog_id' => array(
            'label' => 'Нахождение',
            'value' => (empty($catalog['Catalog']['parent_id']))?0:$catalog['Catalog']['parent_id'],
            'type' => 'select'
        ),
//        'code_1c' => array(
//            'label' => '1С-код',
//            'value' => $catalog['Catalog']['code_1c']
//        ),
        'sort_order' => array(
            'label' => 'Порядок сортировки',
            'value' => $catalog['Catalog']['sort_order'],
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
            'value' => $catalog['Catalog']['short_about'],
            'id' => 'short_about'
        ),
        'long_about' => array(
            'label' => 'Полное описание',
            'value' => $catalog['Catalog']['long_about'],
            'id' => 'long_about'
        )
    ));
    echo $form->hidden('id', array('value' => $catalog['Catalog']['id']));
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