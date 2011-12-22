<?php
echo $html->tag('h2', 'Новости');
$session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Cnew.id'
        ),
        array(
            'header' => 'Вкл',
            'type' => 'checkbox',
            'path' => 'Cnew.enabled',
            'name' => 'enabled'
        ),
        array(
            'header' => 'Англ. название',
            'type' => 'edit',
            'path' => 'Cnew.eng_name',
            'name' => 'eng_name'
        ),
        array(
            'header' => 'Заголовк',
            'type' => 'edit',
            'path' => 'Cnew.caption',
            'name' => 'caption'
        ),
        array(
            'header' => 'Текст',
            'type' => 'text',
            'path' => 'Cnew.text',
            'name' => 'text'
        ),
        array(
            'header' => 'Дата',
            'type' => 'date',
            'path' => 'Cnew.stamp',
            'name' => 'stamp'
        ),
        array(
            'header' => 'Сорт-ка',
            'type' => 'edit',
            'path' => 'Cnew.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'Cnew',
    'id_path' => 'Cnew.id',
    'sortable' => true,
    'link_save_url' => '/cnews/admin_save_all',
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
), $cnews);
?>

<script type="text/javascript">
var cnews = <?php echo $javascript->object($cnews); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '600px',
    'model_name' => 'Cnew',
    'form_action' => 'admin_add',
    'title' => 'Добавление новости',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Англ. название',
            'name' => 'data[eng_name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Заголовок',
            'name' => 'data[caption]'
        ),
        array(
            'type' => 'date',
            'label' => 'Дата',
            'name' => 'data[stamp]'
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
    'model_name' => 'Cnew',
    'form_action' => 'admin_delete',
    'title' => 'Удаление новости',
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
    var page = cnews[row_id];
    dialog.find('.dialog-caption').html(page.Cnew.caption);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>