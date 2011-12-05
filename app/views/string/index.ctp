<h2>Тексты</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Str.id'
        ),
        array(
            'header' => 'Назначение',
            'type' => 'label',
            'path' => 'StringType.name'
        ),
        array(
            'header' => 'Текст',
            'type' => 'text',
            'path' => 'Str.str',
            'name' => 'str'
        )
    ),
    'model_name' => 'Str',
    'id_path' => 'Str.id',
    'link_save_url' => '/strings/save_all'
), $strings);
?>