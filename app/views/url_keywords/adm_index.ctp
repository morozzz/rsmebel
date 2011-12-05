<h2>Управление keywords</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'UrlKeyword.id'
        ),
        array(
            'header' => 'Url',
            'type' => 'edit',
            'path' => 'UrlKeyword.url',
            'name' => 'url'
        ),
        array(
            'header' => 'Keyword',
            'type' => 'edit',
            'path' => 'UrlKeyword.keyword',
            'name' => 'keyword'
        )
    ),
    'model_name' => 'UrlKeyword',
    'id_path' => 'UrlKeyword.id',
    'link_save_url' => '/url_keywords/save_all',
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
), $url_keywords);
?>

<script type="text/javascript">
var url_keywords = <?php echo $javascript->object($url_keywords); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'UrlKeyword',
    'form_action' => 'add',
    'title' => 'Добавление keywords',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Url',
            'name' => 'data[url]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Keyword',
            'name' => 'data[keyword]'
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
    'model_name' => 'UrlKeyword',
    'form_action' => 'delete',
    'title' => 'Удаление keyword',
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
    var page = url_keywords[row_id];
    dialog.find('.dialog-caption').html(page.UrlKeyword.url);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>