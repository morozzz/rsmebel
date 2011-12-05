<h2>Шаблоны изображений</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ImageTemplate.id'
        ),
        array(
            'header' => 'Изображение',
            'type' => 'image',
            'path' => 'Image.url',
            'name' => 'Image'
        ),
        array(
            'header' => 'Процент прозрачности',
            'type' => 'edit',
            'path' => 'ImageTemplate.percent',
            'name' => 'percent'
        )
    ),
    'model_name' => 'ImageTemplate',
    'id_path' => 'ImageTemplate.id',
    'link_save_url' => '/image_templates/save_all',
    'sortable' => false,
    'actions' => array(
        'apply_to_catalog' => 'Применить к товарам',
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Добавить' => array(
            'func_name' => 'add'
        ),
        'Сохранить' => array(
            'type' => 'save'
        )
    )
), $image_templates);
?>

<script type="text/javascript">
var image_templates = <?php echo $javascript->object($image_templates); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'ImageTemplate',
    'form_action' => 'add',
    'title' => 'Добавление шаблона',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'file',
            'label' => 'Изображение',
            'name' => 'data[Image]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Процент прозрач.',
            'name' => 'data[percent]'
        )
    )
));
?>

<script type="text/javascript">
function add() {
    $('#dialog-add .input-clear').val('');
    $('#dialog-add').dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'ImageTemplate',
    'form_action' => 'delete',
    'title' => 'Удаление шаблона',
    'ok_caption' => 'Удалить',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[row_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
));
?>

<script type="text/javascript">
function del(row_id) {
    var dialog = $('#dialog-delete');
    var page = image_templates[row_id];
    dialog.find('.dialog-caption').html(page.ImageTemplate.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-apply-catalog',
    'model_name' => 'ImageTemplate',
    'form_action' => 'apply',
    'title' => 'Применение шаблона к товарам',
    'ok_caption' => 'Применить',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[row_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[type]',
            'value' => 7,
            'clear_class' => false
        )
    )
));
?>

<script type="text/javascript">
function apply_to_catalog(row_id) {
    var dialog = $('#dialog-apply-catalog');
    var page = image_templates[row_id];
    dialog.find('.dialog-caption').html(page.ImageTemplate.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>