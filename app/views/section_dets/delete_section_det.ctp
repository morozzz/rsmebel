<style type="text/css">
#SectionDetSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php
    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('SectionDet', array(
        'action' => 'delete_section_det/'.$section_dets['SectionDet']['id'],
        'id' => 'section-det-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Удалить параметр секции',

          'sort_order' => array(
            'label'    => 'Сортировка',
            'disabled' => 'true',
            'value'    => $section_dets['SectionDet']['sort_order']
          ),
          'param_name' => array(
            'label'    => 'Название параметра',
            'disabled' => 'true',
            'value'    => $section_dets['SectionDet']['param_name']
          )
    ));

    echo $form->hidden('id', array('value' => $section_dets['SectionDet']['id']));

    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>

