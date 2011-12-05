<style type="text/css">
#DesignInfoSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('DesignInfo', array(
        'action' => 'delete/'.$design_infos['DesignInfo']['id'],
        'id' => 'design-info-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Список страниц во вкладке "ДИЗАЙН" - Удалить',

          'sort_order' => array(
            'label'       => 'Сортировка',
            'value' => $design_infos['DesignInfo']['sort_order'],
            'disabled' => true
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => $design_infos['DesignInfo']['news_header'],
            'disabled' => true
          )
    ));

    echo $form->hidden('id', array('value' => $design_infos['DesignInfo']['id']));

    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    enable_validation();
</script>
