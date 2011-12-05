<?php
    $session->flash();

    echo $html->div('image-action',
        $html->image($catalog['SmallImage']['url'])
    );
    echo $html->div('image-action',
        $html->image($catalog['BigImage']['url'])
    );

    echo "<div align=\"center\" class=\"form\">";
    echo $form->create('Catalog', array(
        'action' => 'delete',
        'id' => 'catalog-delete-form'
    ));

    echo $form->inputs(array(
        'legend' => 'Каталог - удаление',
        'name' => array(
            'label' => 'Заголовок',
            'value' => $catalog['Catalog']['name'],
            'readonly' => true
        ),
//        'code_1c' => array(
//            'label' => '1С-код',
//            'value' => $catalog['Catalog']['code_1c'],
//            'readonly' => true
//        ),
        'sort_order' => array(
            'label' => 'Порядок сортировки',
            'value' => $catalog['Catalog']['sort_order'],
            'readonly' => true
        ),
        'short_about' => array(
            'label' => 'Короткое описание',
            'value' => $catalog['Catalog']['short_about'],
            'readonly' => true
        ),
        'long_about' => array(
            'label' => 'Полное описание',
            'value' => $catalog['Catalog']['long_about'],
            'readonly' => true
        )
    ));
    echo $form->hidden('id', array('value' => $catalog['Catalog']['id']));
    echo $form->hidden('', array(
        'value' => $referer,
        'name' => 'data[referer]'
    ));
    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>