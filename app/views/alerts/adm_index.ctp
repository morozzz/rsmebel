<h2>Информационные сообщения</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Alert.id'
        ),
        array(
            'header' => 'Включено',
            'type' => 'label',
            'path' => 'Alert.enable_str'
        ),
        array(
            'header' => 'Заголовок',
            'type' => 'edit',
            'path' => 'Alert.caption',
            'name' => 'caption'
        ),
        array(
            'header' => 'Текст',
            'type' => 'edit',
            'path' => 'Alert.message',
            'name' => 'message'
        ),
        array(
            'header' => 'Дата',
            'type' => 'label',
            'path' => 'Alert.stamp'
        )
    ),
    'model_name' => 'Alert',
    'id_path' => 'Alert.id',
    'link_save_url' => '/alerts/save_all',
    'actions' => array(
        'enabl' => 'Включить',
        'disabl' => 'Отключить',
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
), $alerts);
?>

<script type="text/javascript">
var alerts = <?php echo $javascript->object($alerts); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'Alert',
    'form_action' => 'add',
    'title' => 'Добавление сообщения',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Заголовок',
            'name' => 'data[caption]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Текст',
            'name' => 'data[message]'
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
    'model_name' => 'Alert',
    'form_action' => 'delete',
    'title' => 'Удаление сообщения',
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
    var page = alerts[row_id];
    dialog.find('.dialog-caption').html(page.Alert.caption);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}

function enabl(row_id) {
    window.location = webroot+'alerts/enable/'+row_id;
}

function disabl(row_id) {
    window.location = webroot+'alerts/disable/'+row_id;
}
</script>