<h2>Гостевая</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Guestbook.id'
        ),
        array(
            'header' => 'Вкл.',
            'type' => 'checkbox',
            'path' => 'Guestbook.enabled',
            'name' => 'enabled'
        ),
        array(
            'header' => 'Имя',
            'type' => 'edit',
            'path' => 'Guestbook.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Город',
            'type' => 'edit',
            'path' => 'Guestbook.city',
            'name' => 'city'
        ),
        array(
            'header' => 'Email',
            'type' => 'edit',
            'path' => 'Guestbook.email',
            'name' => 'email'
        ),
        array(
            'header' => 'Телефон',
            'type' => 'edit',
            'path' => 'Guestbook.phone',
            'name' => 'phone'
        ),
        array(
            'header' => 'Сообщение',
            'type' => 'text',
            'path' => 'Guestbook.text',
            'name' => 'text'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'Guestbook.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        ),
        array(
            'header' => 'Дата',
            'type' => 'date',
            'path' => 'Guestbook.created',
            'name' => 'created'
        )
    ),
    'model_name' => 'Guestbook',
    'id_path' => 'Guestbook.id',
    'sortable' => true,
    'link_save_url' => '/guestbooks/admin_save_all',
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
), $guestbooks);
?>

<script type="text/javascript">
var guestbooks = <?php echo $javascript->object($guestbooks); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '600px',
    'model_name' => 'Guestbook',
    'form_action' => 'admin_add',
    'title' => 'Добавление записи',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Имя',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Город',
            'name' => 'data[city]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Email',
            'name' => 'data[email]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Телефон',
            'name' => 'data[phone]'
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
    'model_name' => 'Guestbook',
    'form_action' => 'admin_delete',
    'title' => 'Удаление записи',
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
    var page = guestbooks[row_id];
    dialog.find('.dialog-caption').html(page.Guestbook.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>