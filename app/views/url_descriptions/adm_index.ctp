<h2>Управление descriptions</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'UrlDescription.id'
        ),
        array(
            'header' => 'Url',
            'type' => 'edit',
            'path' => 'UrlDescription.url',
            'name' => 'url'
        ),
        array(
            'header' => 'Description',
            'type' => 'edit',
            'path' => 'UrlDescription.description',
            'name' => 'description'
        )
    ),
    'model_name' => 'UrlDescription',
    'id_path' => 'UrlDescription.id',
    'link_save_url' => '/url_descriptions/save_all',
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
), $url_descriptions);
?>

<script type="text/javascript">
var url_descriptions = <?php echo $javascript->object($url_descriptions); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'UrlDescription',
    'form_action' => 'add',
    'title' => 'Добавление descriptions',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Url',
            'name' => 'data[url]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Description',
            'name' => 'data[description]'
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
    'model_name' => 'UrlDescription',
    'form_action' => 'delete',
    'title' => 'Удаление description',
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
    var page = url_descriptions[row_id];
    dialog.find('.dialog-caption').html(page.UrlDescription.url);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>