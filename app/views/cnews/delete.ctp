<?php

    echo $html->div('image-action',
        $html->image($cnews['SmallImage']['url'])
    );
    echo $html->div('image-action',
        $html->image($cnews['BigImage']['url'])
    );

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Cnew', array(
        'action' => 'delete/'.$cnews['Cnew']['id'],
        'id' => 'cnew-delete-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Новости - удаление',
          'news_header' => array(
          'label'       => 'Заголовок',
          'value' => $cnews['Cnew']['news_header'],
          'disabled' => true
          ),
          'sort_order' => array(
          'label'       => 'Сортировка',
          'value' => $cnews['Cnew']['sort_order'],
          'disabled' => true
          ),
        'small_image_file' => array(
            'label' => 'Маленькое изображение',
            'type' => 'file',
            'size' => 53,
            'disabled' => true
        ),
        'big_image_file' => array(
            'label' => 'Большое изображение',
            'type' => 'file',
            'size' => 53,
            'disabled' => true
        )
    ));

    echo $form->hidden('id', array('value' => $cnews['Cnew']['id']));

    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>
