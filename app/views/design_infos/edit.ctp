<style type="text/css">
#DesignInfoSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('DesignInfo', array(
        'action' => 'edit',
        'id' => 'design-info-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Список страниц во вкладке "ДИЗАЙН" - Редактирование',

          'sort_order' => array(
            'label'       => 'Сортировка',
            'value' => $design_infos['DesignInfo']['sort_order']
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => $design_infos['DesignInfo']['news_header']
          ),
          'news_body' => array(
            'label'       => 'Содержание страницы',
            'value' => $design_infos['DesignInfo']['news_body'],
            'id' => 'news_body',
            'type' => 'textarea'
          )
    ));

    echo $form->hidden('id', array('value' => $design_infos['DesignInfo']['id']));

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
