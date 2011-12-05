<h2>Способы оплаты</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'PayType.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'PayType.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'PayType.sort_order',
            'name' => 'sort_order',
            'sort_column' => 'true'
        )
    ),
    'model_name' => 'PayType',
    'id_path' => 'PayType.id',
    'link_save_url' => '/pay_types/save_all',
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
), $pay_types);
?>

<script type="text/javascript">
var pay_types = <?php echo $javascript->object($pay_types); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'PayType',
    'width' => '600px',
    'form_action' => 'add',
    'title' => 'Добавление способа оплаты',
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
    'model_name' => 'PayType',
    'form_action' => 'delete',
    'title' => 'Удаление способа оплаты',
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
    var page = pay_types[row_id];
    dialog.find('.dialog-caption').html(page.PayType.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>