<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('LoadCatalog', array(
        'action' => 'delete/'.$lcatalogs['LoadCatalog']['id'],
        'id' => 'load_catalog-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Загрузка каталога - удалить',
          'note' => array(
          'label' => 'Комментарий',
          'value' => $lcatalogs['LoadCatalog']['note'],
          'disabled' => true
          ),
        'add_file' => array(
            'label' => 'Файл',
            'type' => 'file',
            'disabled' => true
        )
    ));

    echo $form->hidden('id', array('value' => $lcatalogs['LoadCatalog']['id']));

    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>
