<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('HomeNew', array(
        'action' => 'delete/'.$home_news['HomeNew']['id'],
        'id' => 'home_new-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Информация на главной странице - удалить',

          'priority' => array(
            'label'       => 'Сортировка',
            'value' => $home_news['HomeNew']['priority'],
            'disabled' => true
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => $home_news['HomeNew']['news_header'],
            'disabled' => true
          )
    ));

    echo $form->hidden('id', array('value' => $home_news['HomeNew']['id']));

    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    enable_validation();
</script>