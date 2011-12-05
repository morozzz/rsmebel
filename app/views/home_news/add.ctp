<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('HomeNew', array(
        'action' => 'add',
        'id' => 'home_new-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Информация на главной странице - добавить',

          'priority' => array(
            'label'       => 'Сортировка',
            'value' => 1
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => '',
            'id' => 'news_header',
            'type' => 'textarea'
          ),
          'news_body' => array(
            'label'       => 'Содержание статьи',
            'value' => '',
            'id' => 'news_body',
            'type' => 'textarea'
          )
    ));

    echo $form->hidden('id');

    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.replace('news_body');
        CKEDITOR.replace('news_header');
    }

    enable_validation();
</script>