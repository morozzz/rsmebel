<h2>Быстрые ссылки</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ShortLink.id'
        ),
        array(
            'header' => 'Текст',
            'type' => 'edit',
            'path' => 'ShortLink.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Ссылка',
            'type' => 'edit',
            'path' => 'ShortLink.link',
            'name' => 'link'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'ShortLink.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'ShortLink',
    'id_path' => 'ShortLink.id',
    'sortable' => true,
    'link_save_url' => '/short_links/save_all',
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
), $short_links);
?>

<script type="text/javascript">
var short_links = <?php echo $javascript->object($short_links); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ShortLink',
    'form_action' => 'add',
    'title' => 'Добавление быстрой ссылки',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Текст',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Ссылка',
            'name' => 'data[link]'
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
    'model_name' => 'ShortLink',
    'form_action' => 'delete',
    'title' => 'Удаление быстрой ссылки',
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
    var page = short_links[row_id];
    dialog.find('.dialog-caption').html(page.ShortLink.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>