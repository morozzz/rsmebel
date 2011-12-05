<?php
    $session->flash();

    echo "<div class=\"form\">";
    echo $form->create('Image', array(
        'action' => 'add',
        'id' => 'image-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
        'legend' => 'Изображение - добавление',
        'url' => array(
            'label' => 'Выберите файл с изображением',
            'type' => 'file',
            'size' => '50'
        )
    ));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>