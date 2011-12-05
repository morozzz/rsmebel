<style type="text/css">
#SectionDetSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php
    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('SectionDet', array(
        'action' => 'add_section_det/'.$cur_section_id,
        'id' => 'section-det-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Добавить параметр секции',

          'sort_order' => array(
            'label'       => 'Сортировка',
            'value' => 1
          ),
          'param_name' => array(
            'label'       => 'Название параметра',
            'value' => ''
          )
    ));

    echo $form->hidden('section_id', array('value' => $cur_section_id));
    echo $form->hidden('id');

    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

