<?php
    $session->flash();

    echo $html->div('image-action',
        $html->image($image['Image']['url'])
    );

    echo "<div class=\"form\">";
    echo $form->create('Image', array(
        'action' => 'update',
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
    echo $form->hidden('id', array(
        'value' => $image['Image']['id']
    ));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>