<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('HomeNew', array(
        'action' => 'edit',
        'id' => 'home_new-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Информация на главной странице - редактирование',

          'priority' => array(
            'label'       => 'Сортировка',
            'value' => $home_news['HomeNew']['priority']
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => $home_news['HomeNew']['news_header'],
            'id' => 'news_header',
            'type' => 'textarea'
          ),
          'news_body' => array(
            'label'       => 'Содержание статьи',
            'value' => $home_news['HomeNew']['news_body'],
            'id' => 'news_body',
            'type' => 'textarea'
          )
    ));

    echo $form->hidden('id', array('value' => $home_news['HomeNew']['id']));

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