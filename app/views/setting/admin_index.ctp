<?php echo $html->tag('h1', 'Настройки');?>

<?php
echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Setting.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'label',
            'path' => 'Setting.name'
        ),
        array(
            'header' => 'Изображение',
            'type' => 'image',
            'path' => 'Image.url',
            'name' => 'Image'
        ),
        array(
            'header' => 'Строка (число)',
            'type' => 'edit',
            'path' => 'Setting.value_str',
            'name' => 'value_str'
        ),
        array(
            'header' => 'Текст',
            'type' => 'text',
            'path' => 'Setting.value_text',
            'name' => 'value_text'
        )
    ),
    'model_name' => 'Setting',
    'id_path' => 'Setting.id',
    'sortable' => false,
    'link_save_url' => '/setting/admin_save_all',
    'actions' => array(
    ),
    'buttons' => array(
        'Сохранить' => array(
            'type' => 'save'
        )
    )
), $settings);
?>