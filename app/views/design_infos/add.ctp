<style type="text/css">
#DesignInfoSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('DesignInfo', array(
        'action' => 'add',
        'id' => 'design-info-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Список страниц во вкладке "ДИЗАЙН" - Добавить',

          'sort_order' => array(
            'label'       => 'Сортировка',
            'value' => 1
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => ''
          ),
          'news_body' => array(
            'label'       => 'Содержание страницы',
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
    }

    enable_validation();
</script>
