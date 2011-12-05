<?php

    echo $html->div('image-action',
        $html->image($cnews['SmallImage']['url'])
    );
    echo $html->div('image-action',
        $html->image($cnews['BigImage']['url'])
    );

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Cnew', array(
        'action' => 'edit',
        'id' => 'cnew-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Новости - редактирование',
          'news_header' => array(
          'label'       => 'Заголовок',
          'value' => $cnews['Cnew']['news_header']
          ),
          'sort_order' => array(
          'label'       => 'Сортировка',
          'value' => $cnews['Cnew']['sort_order']
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
            'value' => $cnews['Cnew']['news_footer'],
            'id' => 'news_footer',
            'type' => 'textarea'
        ),
        'news_body' => array(
            'label' => 'Полное описание',
            'value' => $cnews['Cnew']['news_body'],
            'id' => 'news_body',
            'type' => 'textarea'
        )
    ));

    echo $form->hidden('id', array('value' => $cnews['Cnew']['id']));

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