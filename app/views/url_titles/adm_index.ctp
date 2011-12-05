<h2>Управление titles</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'UrlTitle.id'
        ),
        array(
            'header' => 'Url',
            'type' => 'edit',
            'path' => 'UrlTitle.url',
            'name' => 'url'
        ),
        array(
            'header' => 'Title',
            'type' => 'edit',
            'path' => 'UrlTitle.title',
            'name' => 'title'
        )
    ),
    'model_name' => 'UrlTitle',
    'id_path' => 'UrlTitle.id',
    'link_save_url' => '/url_titles/save_all',
    'sortable' => false,
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
), $url_titles);
?>

<script type="text/javascript">
var url_titles = <?php echo $javascript->object($url_titles); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'UrlTitle',
    'form_action' => 'add',
    'title' => 'Добавление titles',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Url',
            'name' => 'data[url]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Title',
            'name' => 'data[title]'
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
    'model_name' => 'UrlTitle',
    'form_action' => 'delete',
    'title' => 'Удаление title',
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
    var page = url_titles[row_id];
    dialog.find('.dialog-caption').html(page.UrlTitle.url);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>