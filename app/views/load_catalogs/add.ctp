<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('LoadCatalog', array(
        'action' => 'add',
        'id' => 'load_catalog-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Загрузка каталога - добавить',
          'note' => array(
          'label'       => 'Комментарий'
          ),
        'add_file' => array(
            'label' => 'Файл',
            'type' => 'file'
        )
    ));

    echo $form->hidden('id');

    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

