<?php
    $session->flash();

    echo $html->div('image-action',
        $html->image($image['Image']['url'])
    );

    echo "<div class=\"form\">";
    echo $form->create('Image', array(
        'action' => 'delete',
        'id' => 'image-delete-form'
    ));
    echo $form->hidden('id', array(
        'value' => $image['Image']['id']
    ));
    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";
?>