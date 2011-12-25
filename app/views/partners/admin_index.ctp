<h1>Партнеры</h1>
<?php
echo $session->flash();
echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Partner.id'
        ),
        array(
            'header' => 'Вкл',
            'type' => 'checkbox',
            'path' => 'Partner.enabled',
            'name' => 'enabled'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'Partner.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Описание',
            'type' => 'text',
            'path' => 'Partner.text',
            'name' => 'text'
        ),
        array(
            'header' => 'Изображение',
            'type' => 'image',
            'path' => 'Image.url',
            'name' => 'Image'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'Partner.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'Partner',
    'id_path' => 'Partner.id',
    'link_save_url' => '/partners/admin_save_all',
    'sortable' => true,
    'actions' => array(
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
), $partners);
?>

<script type="text/javascript">
var partners = <?php echo $javascript->object($partners); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '600px',
    'model_name' => 'Partner',
    'form_action' => 'admin_add',
    'title' => 'Добавление партнера',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
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
    'model_name' => 'Partner',
    'form_action' => 'admin_delete',
    'title' => 'Удаление партнера',
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
    var page = partners[row_id];
    dialog.find('.dialog-caption').html(page.Partner.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>