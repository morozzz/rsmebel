<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Cnew', array(
        'action' => 'add',
        'id' => 'cnew-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Новости - добавить',
          'news_header' => array(
          'label'       => 'Заголовок'
          ),
          'sort_order' => array(
          'label'      => 'Сортировка',
          'value'      => 1  
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
        'news_footer' => array(
            'label' => 'Короткое описание',
            'id' => 'news_footer',
            'type' => 'textarea'
        ),
        'news_body' => array(
            'label' => 'Полное описание',
            'id' => 'news_body',
            'type' => 'textarea'
        )
    ));

    echo $form->hidden('stamp', array('value' => date('Y.m.d')));
    echo $form->hidden('id');

    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.replace('news_footer');

        CKEDITOR.replace('news_body');
    }

    enable_validation();
</script>